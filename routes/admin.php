<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin'],function (){
    Route::get('/', function () {
        return view('Admin/index');
    });
})


?>
