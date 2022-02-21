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

Route::get('/home', function () {
    return view('admin.index');
})->name('/home');

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
    return view('admin.group-access');
})->name('group-access');

Route::get('exit', function () {
    return view('sales.exit');
})->name('exit');




require __DIR__.'/sales/auth.php';


Route::group(['middleware'=>'auth','namespace'=>'Sales'],function(){



//================================ Home ====================================
    Route::get('/','HomeController@index')->name('/');

    require __DIR__.'/sales/CRUD.php';

});

Route::get('creatCapacity','Sales\HomeController@creatCapacity');
