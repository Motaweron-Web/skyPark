<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Support\ServiceProvider;

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
