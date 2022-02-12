<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('sales.index');
    }//end fun

    public function creatCapacity(){

        $latestDayInYear = date('Y',strtotime('+1 year'.date('Y-m-d'))) . '-12-31';
        $newDay = date('Y-m-d');
        $setting = GeneralSetting::latest()->first();
        while ($latestDayInYear != $newDay){
            $array = [];
            $array['count'] = $setting->capacity ?? 1250;
            $array['day'] = $newDay;
            $array['status'] = true;
//            $latestSavedDay =
        }//end while
    }//end fun
}//end class
