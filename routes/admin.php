<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin','middleware'=>'auth:admin','namespace'=>'Admin'],function (){
    Route::get('/home', function () {
        return view('Admin/index');
    });


    #### Admins ####
    Route::group(['prefix' => 'admins'], function () {
        Route::get('/', 'AdminController@index')->name('admin.index');
        Route::post('delete', 'AdminController@delete')->name('delete_admin');
        Route::post('add', 'AdminController@add')->name('add_admin');
        Route::post('edit', 'AdminController@edit')->name('edit_admin');
        Route::get('my_profile','AdminController@my_profile')->name('myProfile');
        Route::post('store-profile','AdminController@saveProfile')->name('store-profile');
    });




    #### Auth ####
    Route::get('logout', 'AuthController@logout')->name('admin.logout');
});

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
    Route::get('login', 'AuthController@index')->name('admin.login');
    Route::POST('login', 'AuthController@login')->name('admin.login');
});
?>
