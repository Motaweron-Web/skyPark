<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\GeneralSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $clients_count = Clients::all()->count();
        $new_clients   = Clients::whereDate('created_at', Carbon::today())->get()->count();
        $clients       = Clients::select('id', 'created_at')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });
        $usermcount = [];
        $userArr    = [];
        foreach ($clients as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }
        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        for ($i = 1; $i <= 12; $i++) {
            if (!empty($usermcount[$i])) {
                $userArr[$i]['count'] = $usermcount[$i];
            } else {
                $userArr[$i]['count'] = 0;
            }
            $userArr[$i]['month'] = $month[$i - 1];
        }
        $clients = array_values($userArr);
        return view('sales.index',compact('clients_count','new_clients','clients'));
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
