<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Reservations;
use App\Models\Ticket;
use Illuminate\Http\Request;

class ExitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $returnArray = [];
        $ticket = [];
        $models = [];
        $customId = [];

        if ($request->has('search')) {

            $ticket = Ticket::where('ticket_num', $request->search)
                ->orWhereHas('client', function($query) use ($request){
                    $query->where('phone',$request->search);
                })
                ->orWhereHas('in_models', function($query) use ($request){
                    $query->where('bracelet_number',$request->search);
                })

                ->with('in_models.type')
                ->where('visit_date', date('Y-m-d'));

        if ($ticket->count() == 0) {
            $ticket = Reservations::whereHas('in_models')
                ->where('custom_id', $request->search)
                ->orWhereHas('in_models', function($query) use ($request){
                    $query->where('bracelet_number',$request->search);
                })
                ->orWhere('phone', $request->search)
                ->with('in_models.type')
                ->where('day', date('Y-m-d'));
        }



        $customId = $ticket->first()->ticket_num??$ticket->first()->custom_id??'';

            $returnArray = [];

            if ($ticket->count() > 0) {

                foreach ($ticket->first()->in_models as $key => $model) {
                    $actions = view('sales.layouts.exit.actions', compact('model', 'key'));


                    $returnArray[$model->id] = "$actions";
                }
                $ticket = $ticket->first();
                $models = $ticket->in_models ?? [];
            }
        }

        count($models)?'':toastr()->warning('there sis no data');
        return view('sales.exit',compact('ticket','returnArray','models','customId'));
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
