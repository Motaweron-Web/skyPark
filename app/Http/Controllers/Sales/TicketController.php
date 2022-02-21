<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\CapacityDays;
use App\Models\Category;
use App\Models\Clients;
use App\Models\GeneralSetting;
use App\Models\Product;
use App\Models\ShiftDetails;
use App\Models\Shifts;
use App\Models\Ticket;
use App\Models\TicketRevModel;
use App\Models\TicketRevProducts;
use App\Models\VisitorTypes;
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            'visit_date'    =>'required|after:yesterday',
            'hours_count'   =>'required',
            'shift_id'      =>'required',
        ]);
        $request->except('_token');
        $ticket = Ticket::where('id',$request->id)->first();
        if(!$ticket){
            $ticket = new Ticket();
        }
            $ticket->visit_date  = $request->visit_date;
            $ticket->shift_id    = $request->shift_id;
            $ticket->hours_count = $request->hours_count;
            $ticket->save();
            $ticket->shift_id = date('h A', strtotime($ticket->shift->from)) ." : ". date('h A', strtotime($ticket->shift->to));
        return response()->json(['ticket' => $ticket,'success' => true]);
    }

    public function calcCapacity(Request $request){
        $request->validate([
            'visit_date'    =>'required|after:yesterday',
            'hours_count'   =>'required',
            'shift_id'      =>'required',
        ]);
        $capacity     = (CapacityDays::where('day',$request->visit_date)->first()->count) ?? GeneralSetting::first()->capacity;
        $booked_count = TicketRevModel::where('day',$request->visit_date)->count();

        // if booked = or > from the day wanted then the day is full
        if($booked_count >= $capacity)
            return response()->json(['day'=>$request->visit_date,'status' => false]);
        else{
            // else then there is a count for new tickets and adjust response
            $available      = $capacity - $booked_count;
            $shift          = Shifts::where('id',$request->shift_id)->first();
            $hours          = $request->hours_count;
            $shift_duration = strtotime($shift->to)-(strtotime($shift->from));
            $shift_prices   = ShiftDetails::where('shift_id',$request->shift_id)->select('visitor_type_id','price')->get();
            // now check if wanted hours is less than shift time then do direct calculations
            if($hours <= $shift_duration/3600) {
                foreach ($shift_prices as $price){
                    $price->price *= $hours;
                }
                return response()->json(['shift_prices' => $shift_prices,'available' => $available,'status' => true]);
            }else{
                // do function
                $visitorTypes  = VisitorTypes::latest()->get();
                $hoursCount    = $request->hours_count;
                $newHoursCount = $request->hours_count;
                $minHorse = 0;

                $shift  = Shifts::findOrFail($request->shift_id);
                $shifts = [];
                $prices = [];
                $pricesArray = [];
                $searchHourArray = [];
                foreach($visitorTypes as $visitorType){
                    $pricesArray[$visitorType->id] = 0;
                }

                while ($newHoursCount > 0){

                    $from = strtotime(date('H',strtotime($shift->from)).":00");
                    $to = strtotime(date('H',strtotime($shift->to)).":00");
                    $difference = round(abs($to - $from) / 3600,2);
                    if ($hoursCount > $difference){
                        $searchHour = $difference;
                    }else{
                        $searchHour = $hoursCount;
                    }

                    if ($newHoursCount < $difference){
                        $searchHour = $newHoursCount;
                    }


                    foreach($visitorTypes as $visitorType){
                        $findShiftDetails = ShiftDetails::where('shift_id',$shift->id)->where('visitor_type_id',$visitorType->id)->firstOrFail();
                        $shifts[] = $findShiftDetails;
                        $pricesArray[$visitorType->id] += $searchHour * $findShiftDetails->price;
                    }
                    $nextId = Shifts::whereTime('from','>=',$shift->to)->max('id');
                    $latestShift = $shift;
                    $shift = Shifts::find($nextId);
                    $newHoursCount = $newHoursCount - $searchHour;

                    if (!$shift){
                        break;
                    }
                }
                $shift_prices = [];
                foreach ($pricesArray as $key=> $item){
                    $smallArray = [];
                    $smallArray['visitor_type_id'] = $key;
                    $smallArray['price'] = $item;
                    $shift_prices[] = $smallArray;
                }
                return response()->json(['shift_prices' => $shift_prices,'available' => $available,'status' => true]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $shifts     = Shifts::all();
        $types      = VisitorTypes::all();
        $categories = Category::with(['products'=>function($query){
            $query->where('status','1');
        }])
            ->whereHas('products',function ($q){
                $q->where('status','1');
            })
            ->get();
        $random = substr(Carbon::now()->format("l"),0,3).rand(0, 999).Carbon::now()->format('is');
        return view('sales/ticket',compact('shifts','random','types','categories','id'));
    }

    public function storeModels(request $request){
        $ticket = Ticket::create([
            'visit_date'     => $request->visit_date,
            'shift_id'       => $request->shift_id,
            'client_id'      => $request->client_id,
            'hours_count'    => $request->duration,
            'total_price'    => $request->total_price,
            'discount_type'  => $request->discount_type[0],
            'discount_value' => $request->discount_value,
            'ticket_num'     => $request->rand_ticket,
            'paid_amount'    => $request->amount,
            'grand_total'    => $request->revenue,
            'rem_amount'     => $request->rem,
        ]);
        for ($i = 0 ; $i < count($request->visitor_type); $i++) {
            TicketRevModel::create([
                'ticket_id'       => $ticket->id,
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
                    'ticket_id' => $ticket->id,
                    'product_id' => $request->product_id[$i],
                    'category_id' => Product::where('id', $request->product_id[$i])->first()->category_id,
                    'qty' => $request->product_qty[$i],
                    'price' => $request->product_price[$i] / $request->product_qty[$i],
                    'total_price' => $request->product_price[$i],
                ]);
            }
        }
        return response()->json(['status' => true]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
