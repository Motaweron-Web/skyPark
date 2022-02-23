<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'admin','middleware'=>'auth:admin','namespace'=>'Admin'],function (){
    Route::get('/', function () {
        return view('Admin/index');
    });


    #### Admins ####
    Route::resource('admins','AdminController');
    Route::POST('admins.delete','AdminController@delete')->name('admins.delete');
    Route::get('my_profile','AdminController@myProfile')->name('myProfile');
    Route::post('store-profile','AdminController@saveProfile')->name('store-profile');




    #### Auth ####
    Route::get('logout', 'AuthController@logout')->name('admin.logout');
});

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
    Route::get('login', 'AuthController@index')->name('admin.login');
    Route::POST('login', 'AuthController@login')->name('admin.login');
});






