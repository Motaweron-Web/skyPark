<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSetting;
use App\Models\GeneralSetting;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $setting = GeneralSetting::first();
        return view('Admin/setting/index',compact('setting'));
    }

    public function edit(UpdateSetting $request){
        $input = $request->except('_token');
        GeneralSetting::first()->update($input);
        toastr()->success('Data Updated Successfully');
        return back();
    }
}
