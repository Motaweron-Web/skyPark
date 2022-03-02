<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
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
}
