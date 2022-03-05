<?php

namespace App\Providers;

use App\Models\ContactUs;
use App\Models\GeneralSetting;
use Illuminate\Support\ServiceProvider;
use Picqer\Barcode\BarcodeGeneratorPNG;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $generatorPNG = new BarcodeGeneratorPNG();
        View::share('generatorPNG',$generatorPNG);
        View::share('setting',GeneralSetting::first());
        View::share('contacts',ContactUs::latest()->take(3)->get());
    }
}
