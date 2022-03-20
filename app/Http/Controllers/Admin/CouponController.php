<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\Reservations;
use App\Models\TicketRevModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{


    public function index(request $request)
    {
        if($request->ajax()) {
            $coupons = Reservations::where('is_coupon','1')->get();
            return Datatables::of($coupons)
                ->addColumn('action', function ($coupons) {
                    return '
                            <button type="button" data-id="' . $coupons->id . '" class="btn btn-pill btn-info-light editBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $coupons->id . '" data-title="' . $coupons->title . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->addColumn('count', function ($coupons) {
                    return TicketRevModel::where('rev_id',$coupons->id)->count();
                })
                ->escapeColumns([])
                ->make(true);
        }else{
            return view('Admin/coupons/index');
        }
    }



    public function create()
    {
        $random = substr(Carbon::now()->format("l"),0,3).rand(0, 999).Carbon::now()->format('is');
        return view('Admin/coupons.parts.create',compact('random'));
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
