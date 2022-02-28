<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Bracelets;
use App\Models\Reservations;
use App\Models\Ticket;
use App\Models\TicketRevModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FamilyAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $ticket = Ticket::whereDate('visit_date', date('Y-m-d'))
                ->where('ticket_num', $request->search)
                ->orWhereHas('client', function($query) use ($request){
                    $query->where('phone',$request->search);
                })->with('append_models.type');


            $bracelet_numbers = [];
            $birthDays = [];
            $names = [];
            $returnArray = [];

            if ($ticket->count() > 0) {

                foreach ($ticket->first()->append_models as $key => $model) {
                    $smallArray = [];
                    $smallArray[] = '#' . $ticket->first()->ticket_num ?? '';
                    $smallArray[] = '#' . $model->type->title ?? '';
                    $custom_ids[] = $ticket->first()->ticket_num ?? '';

                    ///////////////////////////// bracelet /////////////////
                    $bracelet = view('sales.layouts.familyAccess.bracelet', compact('model'));
                    $smallArray[] = "$bracelet";
                    $bracelet_numbers[] = "$bracelet";

                    ///////////////////////////// name /////////////////
                    $name = view('sales.layouts.familyAccess.name', compact('model'));
                    $smallArray[] = "$name";
                    $names[] = "$name";
                    ///////////////////////////// birthDays /////////////////
                    $birthDay = view('sales.layouts.familyAccess.birthDay', compact('model'));
                    $smallArray[] = "$birthDay";
                    $birthDays[] = "$birthDay";
                    ///////////////////////////// gender /////////////////
                    $gender = view('sales.layouts.familyAccess.gender', compact('model'));
                    $smallArray[] = "$gender";
                    ///////////////////////////// actions /////////////////
                    $actions = view('sales.layouts.familyAccess.actions', compact('model', 'key'));
                    $smallArray[] = "$actions";


                    $smallArray[] = "$gender";

                    $returnArray[] = $smallArray;
                }

                return response()->json(['status' => 200, 'backArray' => $returnArray]);

            }

            return response()->json(['status' => 300,]);
        }

        return view('sales.family-access');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'bracelet_number'=>['required',Rule::exists('bracelets','title')->where('status',true)],
            'id'=>['required',Rule::exists('ticket_rev_models','id')->where('status','append')],
            'birthday'=>'nullable',
            'name'=>'nullable|max:500',
            'gender'=>'nullable|in:male,female',
        ]);
        $model = TicketRevModel::findOrFail($request->id);

        if ($model->rev_id != '') {
            $ticket = Reservations::findOrFail($model->rev_id);
        }
        elseif($model->ticket_id != ''){
            $ticket = Ticket::findOrFail($model->ticket_id);

        }else{
            toastr()->info('not found');
            return response(1,500);
        }

        $status['status'] = 'in';
        $data['status'] = 'in';
        $data['start_at'] = date('h:i:s');

        $braceletData['status'] = false;

        Bracelets::where('title',$request->bracelet_number)->update($braceletData);


        $model->update($data);
        $ticket->update($status);
        return response(1);
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
