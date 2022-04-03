<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Activity;
use App\Models\ContactUs;
use App\Models\GeneralSetting;
use App\Models\Offer;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $sliders = Slider::latest()->get();
        $setting = GeneralSetting::first();
        $offers  = Offer::latest()->get();
        return view('site.index',compact('sliders','setting','offers'));
    }

    public function about(){
        $abouts = AboutUs::latest()->get();
        return view('site.about-us',compact('abouts'));
    }

    public function activities(){
        $activities = Activity::latest()->get();
        return view('site.activities',compact('activities'));
    }

    public function terms(){
        return view('site.terms');
    }

    public function groups(){
        return view('site.groups');
    }

    public function contact(){
        return view('site.contact');
    }

    public function storeContact(request $request){
        try {
            $data = $request->validate([
                'first_name'     =>'required|max:255',
                'last_name'      =>'required|max:255',
                'phone'          =>'required|max:255',
                'email'          =>'required|max:255',
                'message'        =>'required',
            ]);
            $data['status'] = '0';
            ContactUs::create($data);
            return redirect()->back()->with('success', 'We Will Answer You As Soon As Possible');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function safety(){
        return view('site.safety');
    }
//    public function offerDetails($id){
//
//    }
}
