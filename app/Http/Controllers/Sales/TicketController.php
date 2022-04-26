<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\CapacityDays;
use App\Models\Category;
use App\Models\Clients;
use App\Models\DiscountReason;
use App\Models\Event;
use App\Models\GeneralSetting;
use App\Models\Product;
use App\Models\Reservations;
use App\Models\ShiftDetails;
use App\Models\Shifts;
use App\Models\Ticket;
use App\Models\TicketRevModel;
use App\Models\TicketRevProducts;
use App\Models\User;
use App\Models\VisitorTypes;
use Carbon\Carbon;
use Carbon\Traits\Date;
use DateTime;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Ramsey\Uuid\Type\Integer;

class TicketController extends Controller
{

    function __construct()
    {

        $this->middleware('permission:Edit Ticket');

    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales/ticket');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            'visit_date' => 'required|after:yesterday',
            'hours_count' => 'required',
            'shift_id' => 'required',
        ]);
        $request->except('_token');
        $ticket = Ticket::where('id', $request->id)->first();
        if (!$ticket) {
            $ticket = new Ticket();
        }
        $ticket->visit_date = $request->visit_date;
        $ticket->shift_id = $request->shift_id;
        $ticket->hours_count = $request->hours_count;
        $ticket->save();
        $ticket->shift_id = date('h A', strtotime($ticket->shift->from)) . " : " . date('h A', strtotime($ticket->shift->to));
        return response()->json(['ticket' => $ticket, 'success' => true]);
    }

    public function calcCapacity(Request $request)
    {
        $request->validate([
            'visit_date'  => 'required|after:yesterday',
            'hours_count' => 'required',
            'shift_id'    => 'required',
        ]);
        $capacity = (CapacityDays::where('day', $request->visit_date)->first()->count) ?? GeneralSetting::first()->capacity;
        $booked_count = TicketRevModel::where('day', $request->visit_date)->where('status','<>','out')->count();

        // if booked = or > from the day wanted then the day is full
        if ($booked_count >= $capacity)
            return response()->json(['day' => $request->visit_date, 'status' => false]);
        else {
            // else then there is a count for new tickets and adjust response
            $available = $capacity - $booked_count;
            $shift = Shifts::where('id', $request->shift_id)->first();
            $hours = $request->hours_count;
            $shift_duration = strtotime($shift->to) - (strtotime($shift->from));
            $shift_prices = ShiftDetails::where('shift_id', $request->shift_id)->select('visitor_type_id', 'price')->get();
            // now check if wanted hours is less than shift time then do direct calculations
            if ($hours <= $shift_duration / 3600) {
                foreach ($shift_prices as $price) {
                    $price->price *= $hours;
                }
                return response()->json(['shift_prices' => $shift_prices, 'available' => $available, 'status' => true]);
            } else {
                // do function
                $visitorTypes = VisitorTypes::latest()->get();
                $hoursCount = $request->hours_count;
                $newHoursCount = $request->hours_count;
                $minHorse = 0;

                $shift = Shifts::findOrFail($request->shift_id);
                $shifts = [];
                $prices = [];
                $pricesArray = [];
                $searchHourArray = [];
                foreach ($visitorTypes as $visitorType) {
                    $pricesArray[$visitorType->id] = 0;
                }

                while ($newHoursCount > 0) {

                    $from = strtotime(date('H', strtotime($shift->from)) . ":00");
                    $to = strtotime(date('H', strtotime($shift->to)) . ":00");
                    $difference = round(abs($to - $from) / 3600, 2);
                    if ($hoursCount > $difference) {
                        $searchHour = $difference;
                    } else {
                        $searchHour = $hoursCount;
                    }

                    if ($newHoursCount < $difference) {
                        $searchHour = $newHoursCount;
                    }


                    foreach ($visitorTypes as $visitorType) {
                        $findShiftDetails = ShiftDetails::where('shift_id', $shift->id)->where('visitor_type_id', $visitorType->id)->firstOrFail();
                        $shifts[] = $findShiftDetails;
                        $pricesArray[$visitorType->id] += $searchHour * $findShiftDetails->price;
                    }
                    $nextId = Shifts::whereTime('from', '>=', $shift->to)->max('id');
                    $latestShift = $shift;
                    $shift = Shifts::find($nextId);
                    $newHoursCount = $newHoursCount - $searchHour;

                    if (!$shift) {
                        break;
                    }
                }
                $shift_prices = [];
                foreach ($pricesArray as $key => $item) {
                    $smallArray = [];
                    $smallArray['visitor_type_id'] = $key;
                    $smallArray['price'] = $item;
                    $shift_prices[] = $smallArray;
                }
                return response()->json(['shift_prices' => $shift_prices, 'available' => $available, 'status' => true]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $id = Clients::findOrFail($id)->id;
        $shifts = Shifts::all();
        $first_shift_start = Carbon::parse(Shifts::orderBy('from', 'ASC')->first()->from)->format('H');
        $types = VisitorTypes::all();
        $categories = Category::with(['products' => function ($query) {
            $query->where('status', '1');
        }])
            ->whereHas('products', function ($q) {
                $q->where('status', '1');
            })
            ->get();
        $customId = strtoupper(date('D') . $id . 'Re' . substr(time(), -2));
        $discounts = DiscountReason::all();
        $random = strtoupper(substr(Carbon::now()->format("l"), 0, 3) . $id . rand(0, 99) . Carbon::now()->format('is'));
        return view('sales/ticket', compact('first_shift_start','discounts', 'customId', 'shifts', 'random', 'types', 'categories', 'id'));
    }

    public function storeModels(request $request)
    {
        $ticket = Ticket::create([
            'add_by'         => auth()->user()->id,
            'visit_date'     => $request->visit_date,
            'shift_id'       => $request->shift_id,
            'client_id'      => $request->client_id,
            'hours_count'    => $request->duration,
            'total_price'    => $request->total_price,
            'discount_type'  => $request->discount_type[0],
            'discount_value' => $request->discount_value,
            'discount_id'    => $request->discount_id,
            'ticket_num'     => $request->rand_ticket,
            'paid_amount'    => $request->amount,
            'grand_total'    => $request->revenue,
            'rem_amount'     => $request->rem,
            'payment_method' => $request->payment_method,
        ]);
        for ($i = 0; $i < count($request->visitor_type); $i++) {
            TicketRevModel::create([
                'ticket_id' => $ticket->id,
                'shift_start' => $request->shift_start.':00'.':00',
                'shift_end' => $request->shift_end.':00'.':00',
                'visitor_type_id' => $request->visitor_type[$i],
                'day' => $request->visit_date,
                'price' => $request->visitor_price[$i],
                'name' => $request->visitor_name[$i],
                'birthday' => $request->visitor_birthday[$i],
                'gender' => $request->gender[$i],
            ]);
        }
        if ($request->has('product_id')) {
            for ($i = 0; $i < count($request->product_id); $i++) {
                TicketRevProducts::create([
                    'ticket_id' => $ticket->id,
                    'product_id' => $request->product_id[$i],
                    'category_id' => Product::where('id', $request->product_id[$i])->first()->category_id,
                    'qty' => $request->product_qty[$i],
                    'price' => $request->product_price[$i] / $request->product_qty[$i],
                    'total_price' => $request->product_price[$i],
                ]);
            }
        }
        $accessUrl    = route('familyAccess.index').'?search='.$ticket->ticket_num;
        $printUrl     = route('ticket.edit',$ticket->id);
        return response()->json([
            'status' => true,
            'accessUrl' => $accessUrl,
            'printUrl'  => $printUrl,
        ]);
    }



    public function edit($id)
    {
        $ticket    = Ticket::with('products.product', 'shift')->findOrFail($id);
        $models    = TicketRevModel::where('ticket_id', $id)->get();
        $date = Carbon::now()->addHours(2);
        return view('layouts.print.ticket', compact('ticket', 'models','date'));
    }

    public function search(){
        $shifts = Shifts::all();
        return view('sales/editTickets',compact('shifts'));
    }

    public function searchForTicket(request $request){
        $tickets = Ticket::query();
        if ($request->searchText != null){
            $tickets->where(function ($q)use($request){
                $q->where('ticket_num',$request->searchText)->orWhereHas('client',function ($q)use($request)
                {
                    $q->where('phone',$request->searchText)->orWhere('name','like','%'.$request->searchText.'%');
                })->orWhereHas('models',function ($q) use($request){
                    $q->where('bracelet_number',$request->searchText);
                });
            });
        }

        if ($request->has('choices_shift') && $request->choices_shift != 'all')
            $tickets->where('shift_id',$request->choices_shift);

        $tickets = $tickets->whereDate('visit_date', Carbon::today())->get();
        $html = [];

        foreach ($tickets as $ticket) {
            $smallArray =[];
            $smallArray[] = '#'.$ticket->ticket_num;
            $smallArray[] = $ticket->visit_date;
            $smallArray[] = $ticket->client->name;
            $smallArray[] = $ticket->client->phone;
            $smallArray[] = (Carbon::parse($ticket->models[0]->shift_start)->format('h:s a')) ?? '';
            $smallArray[] = (Carbon::parse($ticket->models[0]->shift_end)->format('h:s a')) ?? '';
//            $smallArray[] = date('h a', strtotime($ticket->shift->from)).":".date('h a', strtotime($ticket->shift->to));
            $smallArray[] = $ticket->models->count();
            $accessUrl    = route('familyAccess.index').'?search='.$ticket->ticket_num;
            $printUrl     = route('ticket.edit',$ticket->id);
            $editUrl      = route('updateTicket',$ticket->id);
            $title        = $ticket->client->name." - ".$ticket->ticket_num;
            $editSpan     = null;
            $deleteSpan   = null;
            $accessSpan   = null;
            if($ticket->status == 'append')
                $editSpan = '<span class="icon" data-bs-toggle="tooltip" title="edit" data-id="'.$ticket->id.'"><a href="'.$editUrl.'"><i class="far fa-edit"></i></a></span>';

            if($ticket->status != 'in' && $ticket->status != 'out')
                $deleteSpan = '<span class="icon deleteSpan" data-bs-toggle="tooltip" title=" delete "  data-title="'.$title.'" data-id="'.$ticket->id.'"> <i class="far fa-trash-alt"></i>  </span>';

            if($ticket->status == 'append')
                $accessSpan = '<span class="icon" data-bs-toggle="tooltip" title="Access"><a href="'.$accessUrl.'"><i class="fal fa-check "></i></a></span>';

            $smallArray[] = '<span class="controlIcons">
                  <span class="icon" data-bs-toggle="tooltip" title="print"><a target="_blank" href="'.$printUrl.'"><i class="far fa-print"></i> </a> </span>
                  '.$editSpan.'
                  '.$deleteSpan.'
                  <span class="icon showSpan" data-bs-toggle="tooltip" title=" details " data-id="'.$ticket->id.'"> <i class="fas fa-eye"></i></i>  </span>
                  '.$accessSpan.'
                </span>';
            $html[] = $smallArray;
        }
        return response()->json(['html' => $html,'status' => 200]);
    }

    public function updateTicket($id){
        $ticket     = Ticket::where([['id',$id],['status','append']])->firstOrFail();
        $add_by     = User::where('id',$ticket->add_by)->first()->name;
        $types      = VisitorTypes::all();
        $models     = TicketRevModel::where('ticket_id',$id)->get();
        $categories = Category::with(['products'=>function($query){
            $query->where('status','1');
        }])->whereHas('products',function ($q){
            $q->where('status','1');
        })->get();
        $products = TicketRevProducts::where('ticket_id',$id)->get();
        $prices = $this->getPrices($ticket->hours_count,$ticket->shift_id);
        return view('sales.updateTicket',compact('ticket','add_by','prices','products','models','types','categories'));
    }

    public function restoreTicket(request $request){
        $ticket      = Ticket::findOrFail($request->ticket_id);
        $shift_start = $ticket->models->first()->shift_start;
        $shift_end   = $ticket->models->first()->shift_end;
        $day         = $ticket->models->first()->day;
        foreach ($ticket->models as $model){
            $model->delete();
        }
        $ticket->update([
            'total_price'    => $request->total_price,
            'discount_type'  => $request->discount_type[0],
            'discount_value' => $request->discount_value,
            'paid_amount'    => $request->amount,
            'grand_total'    => $request->revenue,
            'rem_amount'     => $request->rem,
        ]);
        for ($i = 0 ; $i < count($request->visitor_type); $i++) {
            TicketRevModel::create([
                'ticket_id'       => $ticket->id,
                'shift_start'     => $shift_start,
                'shift_end'       => $shift_end,
                'day'             => $day,
                'visitor_type_id' => $request->visitor_type[$i],
                'price'           => $request->visitor_price[$i],
                'name'            => $request->visitor_name[$i],
                'birthday'        => $request->visitor_birthday[$i],
                'gender'          => ($request->gender[$i]) ?? null,
            ]);
        }
        foreach ($ticket->products as $product){
            $product->delete();
        }
        if($request->has('product_id')) {
            for ($i = 0; $i < count($request->product_id); $i++) {
                TicketRevProducts::create([
                    'ticket_id'   => $ticket->id,
                    'product_id'  => $request->product_id[$i],
                    'category_id' => Product::where('id', $request->product_id[$i])->first()->category_id,
                    'qty'         => $request->product_qty[$i],
                    'price'       => $request->product_price[$i] / $request->product_qty[$i],
                    'total_price' => $request->product_price[$i],
                ]);
            }
        }
        $accessUrl    = route('familyAccess.index').'?search='.$ticket->ticket_num;
        $printUrl     = route('ticket.edit',$ticket->id);
        return response()->json([
            'status' => true,
            'accessUrl' => $accessUrl,
            'printUrl'  => $printUrl,
        ]);
    }

    public function getPrices($hours_count,$shift_id)
    {
        $shift = Shifts::where('id', $shift_id)->first();
        $hours = $hours_count;
        $shift_duration = strtotime($shift->to) - (strtotime($shift->from));
        $shift_prices = ShiftDetails::where('shift_id', $shift_id)->select('visitor_type_id', 'price')->get();
        // now check if wanted hours is less than shift time then do direct calculations
        if ($hours <= $shift_duration / 3600) {
            foreach ($shift_prices as $price) {
                $price->price *= $hours;
            }
            return $shift_prices;
        } else {
            // do function
            $visitorTypes = VisitorTypes::latest()->get();
            $hoursCount = $hours_count;
            $newHoursCount = $hours_count;
            $minHorse = 0;

            $shift = Shifts::findOrFail($shift_id);
            $shifts = [];
            $prices = [];
            $pricesArray = [];
            $searchHourArray = [];
            foreach ($visitorTypes as $visitorType) {
                $pricesArray[$visitorType->id] = 0;
            }

            while ($newHoursCount > 0) {

                $from = strtotime(date('H', strtotime($shift->from)) . ":00");
                $to = strtotime(date('H', strtotime($shift->to)) . ":00");
                $difference = round(abs($to - $from) / 3600, 2);
                if ($hoursCount > $difference) {
                    $searchHour = $difference;
                } else {
                    $searchHour = $hoursCount;
                }

                if ($newHoursCount < $difference) {
                    $searchHour = $newHoursCount;
                }


                foreach ($visitorTypes as $visitorType) {
                    $findShiftDetails = ShiftDetails::where('shift_id', $shift->id)->where('visitor_type_id', $visitorType->id)->firstOrFail();
                    $shifts[] = $findShiftDetails;
                    $pricesArray[$visitorType->id] += $searchHour * $findShiftDetails->price;
                }
                $nextId = Shifts::whereTime('from', '>=', $shift->to)->max('id');
                $latestShift = $shift;
                $shift = Shifts::find($nextId);
                $newHoursCount = $newHoursCount - $searchHour;

                if (!$shift) {
                    break;
                }
            }
            $shift_prices = [];
            foreach ($pricesArray as $key => $item) {
                $smallArray = [];
                $smallArray['visitor_type_id'] = $key;
                $smallArray['price'] = $item;
                $shift_prices[] = $smallArray;
            }
            return $shift_prices;
        }
    }



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

    public function details($id){
        $ticket   = Ticket::findOrFail($id);
        $products = TicketRevProducts::where('ticket_id',$ticket->id)->get();
        $models  = $ticket->models->groupBy('visitor_type_id');
        return view('sales.layouts.ticket.details',compact('ticket','models','products'));
    }

    public function delete_ticket(request $request){
        $ticket = Ticket::where('id', $request->id)->first();
        if($ticket->status == 'append') {
            foreach ($ticket->models as $model){
                $model->delete();
            }
            $ticket->delete();
            return response(['message' => 'Data Deleted Successfully', 'status' => 200], 200);
        }
        else
            return response(['message' => "You Can't Delete This Ticket !", 'status' => 405], 200);
    }

    public function getShifts(request $request)
    {
        $selected_start = null;
        $selected_end   = null;
        $rev = Reservations::where('id',$request->id)->first();
        if($rev){
            $selected_start = Carbon::parse($rev->models[0]->shift_start)->format('H');
            $selected_end   = Carbon::parse($rev->models[0]->shift_end)->format('H');
        }
        $visit_date = $request->visit_date;
        $times = [];
        $shift_id = [];
        $starts = [];
        $ends   = [];
        if (Carbon::parse($visit_date)->isToday()) {
            $start_time  = date('H:i', strtotime('+2 hours'));
            $time_format = date('H:i', strtotime('+2 hours')).':00';
        } else {
            $start_time  = Carbon::parse(Shifts::orderBy('from', 'ASC')->first()->from)->format('H');
            $time_format = Carbon::parse(Shifts::orderBy('from', 'ASC')->first()->from)->format('H').':00';
        }
        $i = (int)$start_time + $request->duration;
        while ($i <= 24) {
            $shift = Shifts::where(function ($query) use ($time_format){
                $query->where('from', '<=', $time_format)->where('to', '>', $time_format);
            })->first();
            if($shift != null){
                $shift_id[] = $shift->id;
                if (((int)$start_time + $request->duration) < 12 && ((int)$start_time + $request->duration) % 12 != 0 && ((((int)$start_time + (int)$request->duration)) % 12) != 0 && (((int)$start_time) % 12) != 0)
                    $times[]  = 'From ' . (((int)$start_time) % 12) . ' To ' . ((((int)$start_time + (int)$request->duration)) % 12) . ' AM';
                else if(((int)$start_time + $request->duration) > 12 && ((int)$start_time + $request->duration) % 12 != 0 && ((((int)$start_time + (int)$request->duration)) % 12) != 0 && (((int)$start_time) % 12) != 0)
                    $times[] = 'From ' . (((int)$start_time) % 12) . ' To ' . ((((int)$start_time + (int)$request->duration)) % 12) . ' PM';
                else{
                    $from = (((int)$start_time) % 12) == 0 ? '12' : (((int)$start_time) % 12);
                    $to   = ((((int)$start_time + (int)$request->duration)) == 12) == 12 ? '12 PM' : '12 AM';
                    if((((int)$start_time + (int)$request->duration)) == 12){
                        $to = '12 PM';
                    }elseif ((((int)$start_time + (int)$request->duration)) == 24){
                        $to = '12 AM';
                    }elseif((((int)$start_time + (int)$request->duration)) > 12 && (((int)$start_time + (int)$request->duration)) != 24){
                        $to = ((((int)$start_time + (int)$request->duration)) % 12).' PM';
                    }
                    $times[] = 'From ' . $from . ' To ' .$to;
                }
                $starts[] = ((int)$start_time);
                $ends[]   = (((int)$start_time + (int)$request->duration));
                $time_format = ((int)$start_time + (int)$request->duration).':00';
                $start_time  = ((int)$start_time + 1);
                $i++;
            }else{
                $time_format = ((int)$start_time + (int)$request->duration).':00';
                $start_time  = ((int)$start_time + 1);
                $i++;
            }
        }
        return response(['times' => $times,'selected_start' => $selected_start,'selected_end' => $selected_end,'starts'=> $starts,'ends'=>$ends,'shift_id' => $shift_id, 'status' => 200], 200);
    }
}
