<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Picqer\Barcode\BarcodeGeneratorPNG;

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
    }
}
