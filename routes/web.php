<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('add-client', function () {
    return view('admin.add-client');
})->name('add-client');

Route::get('ticket', function () {
    return view('sales.ticket');
})->name('ticket');

Route::get('family-access', function () {
    return view('sales.family-access');
})->name('family-access');


Route::get('capacity', function () {
    return view('admin.capacity');
})->name('capacity');

Route::get('group-access', function () {
    return view('sales.group-access');
})->name('group-access');




require __DIR__.'/sales/auth.php';


Route::group(['middleware'=>'auth','namespace'=>'Sales'],function(){



//================================ Home ====================================
    Route::get('/','HomeController@index')->name('/');

    require __DIR__.'/sales/CRUD.php';

});
Route::group(['namespace'=>'Sales'],function(){

    //=========================== visitor Types Prices ============================
    Route::get('visitorTypesPrices','VisitorTypesPricesController@visitorTypesPrices')->name('visitorTypesPrices');

});

Route::get('creatCapacity','Sales\HomeController@creatCapacity');



//================================ Admin Dashboard ====================================
require __DIR__.'/admin.php';
