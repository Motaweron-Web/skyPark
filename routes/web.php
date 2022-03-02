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


Route::get('/', 'Site\HomeController@index')->name('/');
Route::get('about_us', 'Site\HomeController@about')->name('about_us');





require __DIR__.'/sales/auth.php';


Route::group(['middleware'=>'auth','namespace'=>'Sales'],function(){



//================================ Home ====================================
    Route::get('/sales','HomeController@index')->name('sales');

    require __DIR__.'/sales/CRUD.php';

});
Route::group(['namespace'=>'Sales'],function(){

    //=========================== visitor Types Prices ============================
    Route::get('visitorTypesPrices','VisitorTypesPricesController@visitorTypesPrices')->name('visitorTypesPrices');

});

Route::get('creatCapacity','Sales\HomeController@creatCapacity');



//================================ Admin Dashboard ====================================
require __DIR__.'/admin.php';
