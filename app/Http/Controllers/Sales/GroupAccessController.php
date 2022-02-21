<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Reservations;
use App\Models\TicketRevModel;
use Illuminate\Http\Request;

class GroupAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){

        $reservation = Reservations::where('custom_id', $request->search)
            ->orWhere('phone', $request->search)->with('append_models.type')
            ->where('day', date('Y-m-d'));


        $bracelet_numbers = [];
        $birthDays = [];
        $names = [];
        $returnArray = [];

        if ($reservation->count() > 0) {
            foreach ($reservation->first()->append_models as $key =>$model) {
                $smallArray = [];
                $smallArray[] = '#'.$reservation->first()->custom_id??'';
                $smallArray[] = '#'.$model->type->title??'';
                $custom_ids[] = $reservation->first()->custom_id??'';

                ///////////////////////////// bracelet /////////////////
                $bracelet = view('sales.layouts.groupAccess.bracelet',compact('model'));
                $smallArray[] = "$bracelet";
                $bracelet_numbers[] = "$bracelet";

                ///////////////////////////// name /////////////////
                $name = view('sales.layouts.groupAccess.name',compact('model'));
                $smallArray[] = "$name";
                $names[] = "$name";
                ///////////////////////////// birthDays /////////////////
                $birthDay = view('sales.layouts.groupAccess.birthDay',compact('model'));
                $smallArray[] = "$birthDay";
                $birthDays[] = "$birthDay";
                ///////////////////////////// gender /////////////////
                $gender = view('sales.layouts.groupAccess.gender',compact('model'));
                $smallArray[] = "$gender";
                ///////////////////////////// actions /////////////////
                $actions = view('sales.layouts.groupAccess.actions',compact('model','key'));
                $smallArray[] = "$actions";


                $smallArray[] = "$gender";

                $returnArray[] = $smallArray;
            }

            return response()->json(['status' => 200,'backArray'=>$returnArray]);

        }

        return response()->json(['status' => 300,]);
        }

        return view('sales.group-access');
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
