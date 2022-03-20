<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Bracelets;
use App\Models\Reservations;
use App\Models\Ticket;
use App\Models\TicketRevModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GroupAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        if ($request->ajax()) {

            $reservation = Reservations::where('status','append')
                ->whereDate('day', date('Y-m-d'))
                ->where('custom_id', $request->search)
                ->orwhere('ticket_num', $request->search)
                ->orwhere('client_name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', $request->search)->with('append_models.type');


            $bracelet_numbers = [];
            $birthDays = [];
            $names = [];
            $returnArray = [];

            if ($reservation->count() > 0) {
                foreach ($reservation->first()->append_models as $key => $model) {
                    $smallArray = [];
                    $smallArray[] = '#' . $reservation->first()->custom_id ?? '';
                    $smallArray[] = '#' . $model->type->title ?? '';
                    $custom_ids[] = $reservation->first()->custom_id ?? '';

                    ///////////////////////////// bracelet /////////////////
                    $bracelet = view('sales.layouts.groupAccess.bracelet', compact('model'));
                    $smallArray[] = "$bracelet";
                    $bracelet_numbers[] = "$bracelet";

                    ///////////////////////////// name /////////////////
                    $name = view('sales.layouts.groupAccess.name', compact('model'));
                    $smallArray[] = "$name";
                    $names[] = "$name";
                    ///////////////////////////// birthDays /////////////////
                    $birthDay = view('sales.layouts.groupAccess.birthDay', compact('model'));
                    $smallArray[] = "$birthDay";
                    $birthDays[] = "$birthDay";
                    ///////////////////////////// gender /////////////////
                    $gender = view('sales.layouts.groupAccess.gender', compact('model'));
                    $smallArray[] = "$gender";
                    ///////////////////////////// actions /////////////////
                    $actions = view('sales.layouts.groupAccess.actions', compact('model', 'key'));
                    $smallArray[] = "$actions";


                    $smallArray[] = "$gender";

                    $returnArray[] = $smallArray;
                }
                return response()->json(['status' => 200, 'backArray' => $returnArray]);

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
        $data = $request->validate([
            'bracelet_number'=>['required',Rule::exists('bracelets','title')->where('status','1')],
            'id'=>['required',Rule::exists('ticket_rev_models','id')->where('status','append')],
            'birthday'=>'nullable',
            'name'=>'nullable|max:500',
            'gender'=>'nullable|in:male,female',
        ]);
        $model = TicketRevModel::findOrFail($request->id);

        $data['status'] = 'in';
        $status['status'] = 'in';

        if ($model->rev_id != '') {
            $ticket = Reservations::findOrFail($model->rev_id);
        }
        elseif($model->ticket_id != ''){
            $ticket = Ticket::findOrFail($model->ticket_id);

        }else{
            toastr()->info('not found');
            return response(1,500);
        }
        $braceletData['status'] = '0';

        Bracelets::where('title',$request->bracelet_number)->update($braceletData);

        $model->update($data);
        $ticket->update($status);
        return response(1);
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
    }//end fun

    public function getBracelets(Request $request)
    {
        $count = $request->count;
        $firstBracelet = $request->firstBracelet;

        $findFirst = Bracelets::where('title', $firstBracelet)
            ->where('status', '1')->firstOrFail();


        $getFreeBracelets = Bracelets::where('status', '1')->get();

        $bracelets = array();
        $characters = array();
        $stringChar = '';

        ////////////////////// الحرووف //////////////////////////////
        foreach (range('A', 'Z') as $char) {
            $stringChar = $stringChar . $char;
            $characters[$char] = 0;
        }

        $searchBracelet = $firstBracelet;

        ////////////////////////// اول كود /////////////////////////////////
        $bracelets[] = $searchBracelet;
        $firstCharacter = substr($firstBracelet, 0, 1);
        $characters[$firstCharacter]++;
        $number = substr($firstBracelet, 1);
        $firstNumber = substr($firstBracelet, 1);


        $countBeforeNumber = 0;

        /////////////////////////////// عدد الاكواد قبل الكود الاول //////////////////////////////////
        if ($firstNumber > 1) {
            foreach (range(1, $firstNumber - 1) as $number_) {
                $countBeforeNumber++;
            }
        }

        ////////////////////////////////////// ربط الرقم بالحرف ////////////////////////////////////////////////
        $number++;
        if ($number < 10) {
            $searchBracelet = $firstCharacter . '0' . $number;
        } else {
            $searchBracelet = $firstCharacter . $number;
        }


        /////////////////////////////// التأكد من الكود التانى //////////////////////////////
        for ($i = 0; $i < Bracelets::checkIfCharIsFree($firstCharacter); $i++) {
            if (!Bracelets::checkIsFree($searchBracelet)) {
                $number++;
                if ($number < 10) {
                    $searchBracelet = $firstCharacter . '0' . $number;
                } else {
                    $searchBracelet = $firstCharacter . $number;
                }
            } else {
                break;
            }
        }

        while (Bracelets::checkIsFree($searchBracelet)) {

            $bracelets[] = $searchBracelet;

            //////////////////////////////// الكود //////////////////////
            $firstCharacter = substr($searchBracelet, 0, 1);
            $characters[$firstCharacter]++;
            $number = substr($searchBracelet, 1);
            $number++;
            if ($number < 10) {
                $searchBracelet = $firstCharacter . '0' . $number;
            } else {
                $searchBracelet = $firstCharacter . $number;
            }

            /////////////////////////////////// التأكد من انتهاء الحرف وزيادة الحرف الذي يلية ////////////////////////////////////////
            if ($characters[$firstCharacter] >= Bracelets::checkIfCharIsFree($firstCharacter)) {
                $index = strpos($stringChar, $firstCharacter) + strlen($firstCharacter);
                $result = substr($stringChar, $index);
                $firstCharacter = substr($result, 0, 1);
                $number = 1;
                $searchBracelet = $firstCharacter . '0' . $number;
            }

            ///////////////////////////// التأكد من توفر الكود لعد انتهاء البحث عن الكود /////////////////////////////
            for ($i = 0; $i < Bracelets::checkIfCharIsFree($firstCharacter); $i++) {
                if (!Bracelets::checkIsFree($searchBracelet)) {
                    $number++;
                    if ($number < 10) {
                        $searchBracelet = $firstCharacter . '0' . $number;
                    } else {
                        $searchBracelet = $firstCharacter . $number;
                    }
                } else {
                    $bracelets[] = $searchBracelet;

                    break;
                }
            }
            //////////////////////////// الإنهاء بعد الحصول على الاكواد المطلوبة ///////////////////////////////////
            if (count($bracelets) >= $count) {
                break;
            }
        }

        return response()->json($bracelets);


    }//end fun
    public function getBraceletsTwo(Request $request)
    {

        $getBracelets = Bracelets::
            BraceletFree()->orderBy('title')->take($request->count)->pluck('title')->toArray();

        return response()->json($getBracelets);


    }//end fun


}//end class
