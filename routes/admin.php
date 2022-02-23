<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'admin','middleware'=>'auth:admin','namespace'=>'Admin'],function (){
    Route::get('/', function () {
        return view('Admin/index');
    })->name('adminHome');


    #### Admins ####
    Route::resource('admins','AdminController');
    Route::POST('admins.delete','AdminController@delete')->name('admins.delete');
    Route::get('my_profile','AdminController@myProfile')->name('myProfile');
    Route::post('store-profile','AdminController@saveProfile')->name('store-profile');

    #### Categories ####
    Route::resource('category','CategoryController');
    Route::POST('category.delete','CategoryController@delete')->name('category.delete');

    #### Products ####
    Route::resource('product','ProductController');
    Route::POST('product.delete','ProductController@delete')->name('product.delete');

    #### Bracelets ####
    Route::resource('bracelet','BraceletsController');
    Route::POST('bracelet.delete','BraceletsController@delete')->name('bracelet.delete');

    #### References ####
    Route::resource('reference','RefernceController');
    Route::POST('reference.delete','RefernceController@delete')->name('reference.delete');

    #### Users ####
    Route::resource('users','UsersController');
    Route::POST('users.delete','UsersController@delete')->name('users.delete');

    #### Capacity ####
    Route::resource('capacities','CapacityController');
    Route::POST('capacities.delete','CapacityController@delete')->name('capacities.delete');



    #### Auth ####
    Route::get('logout', 'AuthController@logout')->name('admin.logout');
});

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
    Route::get('login', 'AuthController@index')->name('admin.login');
    Route::POST('login', 'AuthController@login')->name('admin.login');
});






