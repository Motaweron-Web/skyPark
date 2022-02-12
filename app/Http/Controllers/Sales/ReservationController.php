<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Governorate;
use App\Models\Reservations;
use App\Models\ReservationsBirthDayInfo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('sales.reservations');
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
        $id = base64_decode($id)/555;
        return view('sales.reservation-info');
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
