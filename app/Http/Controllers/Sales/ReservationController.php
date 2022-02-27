<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\Governorate;
use App\Models\Product;
use App\Models\Reservations;
use App\Models\ReservationsBirthDayInfo;
use App\Models\Shifts;
use App\Models\Ticket;
use App\Models\TicketRevModel;
use App\Models\TicketRevProducts;
use App\Models\VisitorTypes;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $events = Event::latest()->get();
        $shifts     = Shifts::all();
        return view('sales.reservations',compact('events','shifts'));
    }

    public function searchForReservations(request $request){
        $reservation = Reservations::query();
        if ($request->searchText != null)
            $reservation->where('ticket_num',$request->searchText);

        if ($request->has('choices_type') && $request->choices_type != 'all')
            $reservation->where('event_id',$request->choices_type);

        if ($request->has('choices_shift'))
            $reservation->where('shift_id',$request->choices_shift);

        $reservation = $reservation->latest()->get();
        $html = [];
        foreach ($reservation as $rev) {
            $smallArray =[];
            $smallArray[] = $rev->ticket_num;
            $smallArray[] = $rev->day;
            $smallArray[] = $rev->event->title;
            $smallArray[] = $rev->client_name;
            $smallArray[] = $rev->phone;
            $smallArray[] = date('h a', strtotime($rev->shift->from)).":".date('h a', strtotime($rev->shift->to));
            $smallArray[] = $rev->models->count();
            $accessUrl = route('groupAccess.index').'?search='.$rev->ticket_num;
            $smallArray[] = '<span class="controlIcons">
                  <span class="icon" data-bs-toggle="tooltip" title="edit"> <i class="far fa-edit me-2"></i> Edit </span>
                  <span class="icon deleteSpan" data-toggle="modal" data-target="#delete_modal" data-bs-toggle="tooltip" title=" delete " data-id="'.$rev->id.'"> <i class="far fa-trash-alt me-2"></i> Delete </span>
                  <span class="icon" data-bs-toggle="tooltip" title=" details "> <i class="fas fa-eye me-2"></i></i> Show </span>
                  <span class="icon" data-bs-toggle="tooltip" title="Access"> <i class="fal fa-check me-2"></i><a href="'.$accessUrl.'">Access</a></span>
                </span>';
            $html[] = $smallArray;
        }
        return response()->json(['html' => $html,'status' => 200]);
    }

    public function delete_reservation(request $request){
        $reservation = Reservations::where('id', $request->id)->first();
        if($reservation->status == 'append') {
            $reservation->delete();
            return response(['message' => 'Data Deleted Successfully', 'status' => 200], 200);
        }
        else
            return response(['message' => "You Can't Delete This Reservation !", 'status' => 405], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $events = Event::latest()->get();
        $governorates = Governorate::with('cities')->latest()->get();
        try {
            $date = date('Y-m-d', base64_decode($request->day));
        } catch (Exception $e) {
            toastr()->warning('You must choose a correct date');
            return redirect('capacity?month=' . date('Y-m'));
        }

        if (date('Y-m-d') > $date) {
            toastr()->warning('You must choose a correct date');
            return redirect('capacity?month=' . date('Y-m'));
        }
        return view('sales.add-reservation', compact('events', 'governorates', 'date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $date = $request->validate([
            'day' => 'required|date_format:Y-m-d|after:yesterday',
            'client_name' => 'required|string|max:500',
            'email' => 'nullable|string|max:500',
            'phone' => 'nullable|string|numeric',
            'event_id' => 'required|exists:events,id',
            'gov_id' => 'required|exists:governorates,id',
            'city_id' => ['required', Rule::exists('cities', 'id')->where('gov_id', $request->gov_id)],
            'gender' => 'required|in:male,female',

        ]);

        if ($request->event_id == 1) {
            $request->validate([
                'name' => 'required|string|max:500',
                'email_' => 'nullable|string|max:200',
                'gender_' => 'required|in:male,female',
                'phone_' => 'nullable|string|numeric',

            ]);

        }

        $storeMain = Reservations::create($date);
        if ($request->event_id == 1) {
            $revInfo = [];
            $revInfo['name'] = $request->name;
            $revInfo['email'] = $request->email_;
            $revInfo['phone'] = $request->phone;
            $revInfo['gender'] = $request->gender;
            $revInfo['birthday'] = $request->day;
            $revInfo['rev_id'] = $storeMain->id;
            ReservationsBirthDayInfo::create();
        }

        if ($storeMain){
            $url = route('reservations.edit',base64_encode($storeMain->id * 555));
        }
        return response()->json(['status'=>200,'url'=>$url]);

    }

    public function storeRevTicket(request $request){
        Reservations::where('id',$request->rev_id)->first()->update([
            'shift_id'       => $request->shift_id,
            'hours_count'    => $request->duration,
            'total_price'    => $request->total_price,
            'discount_type'  => $request->discount_type[0],
            'discount_value' => $request->discount_value,
            'ticket_num'     => $request->rand_ticket,
            'custom_id'     => $request->rand_ticket,
            'paid_amount'    => $request->amount,
            'grand_total'    => $request->revenue,
            'rem_amount'     => $request->rem,

        ]);
        for ($i = 0 ; $i < count($request->visitor_type); $i++) {
            TicketRevModel::create([
                'rev_id'          => Reservations::where('id',$request->rev_id)->first()->id,
                'visitor_type_id' => $request->visitor_type[$i],
                'day'             => $request->visit_date,
                'price'           => $request->visitor_price[$i],
                'name'            => $request->visitor_name[$i],
                'birthday'        => $request->visitor_birthday[$i],
                'gender'          => $request->gender[$i],
            ]);
        }
        if($request->has('product_id')) {
            for ($i = 0; $i < count($request->product_id); $i++) {
                TicketRevProducts::create([
                    'rev_id'      => Reservations::where('id',$request->rev_id)->first()->id,
                    'product_id'  => $request->product_id[$i],
                    'category_id' => Product::where('id', $request->product_id[$i])->first()->category_id,
                    'qty'         => $request->product_qty[$i],
                    'price'       => $request->product_price[$i] / $request->product_qty[$i],
                    'total_price' => $request->product_price[$i],
                ]);
            }
        }
        $day = Carbon::parse(Reservations::where('id',$request->rev_id)->first()->day)->format('Y-m');
        return response()->json(['day'=>$day,'status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('layouts.print.rev');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|\Illuminate\Http\Response|View
     */
    public function edit($id)
    {
        $id = base64_decode($id)/555;
        $types        = VisitorTypes::all();
        $reservation  = Reservations::findOrFail($id);
        $customId     = strtoupper(date('D').$id.'Re'.substr(time(), -2));
        $shifts       = Shifts::latest()->get();
        $visitorTypes = VisitorTypes::latest()->get();
        $categories = Category::with(['products'=>function($query){
            $query->where('status','1');
        }])
            ->whereHas('products',function ($q){
                $q->where('status','1');
            })
            ->get();
        $random = substr(Carbon::now()->format("l"),0,3).rand(0, 999).Carbon::now()->format('is');
        return view('sales.reservation-info',compact('id','random','categories','types','reservation','customId','shifts','visitorTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
