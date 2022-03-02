<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSetting;
use App\Models\GeneralSetting;
use App\Models\Setting;
use App\Traits\PhotoTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use PhotoTrait;
    public function index(){
        $setting = GeneralSetting::first();
        return view('Admin/setting/index',compact('setting'));
    }

    public function edit(UpdateSetting $request){
        $input = $request->except('_token');
        if($request->has('logo')){
            $file_name = $this->saveImage($request->logo,'assets/uploads');
            $input['logo'] = 'assets/uploads/'.$file_name;
        }
        GeneralSetting::first()->update($input);
        toastr()->success('Data Updated Successfully');
        return back();
    }

    public function getLogo(){
        return asset(GeneralSetting::first()->logo);
    }
}
