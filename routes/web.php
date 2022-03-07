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
Route::get('offer_details/{id}', 'Site\HomeController@offerDetails')->name('offer_details');

## About
Route::get('about_us', 'Site\HomeController@about')->name('about_us');

## Terms
Route::get('terms', 'Site\HomeController@terms')->name('terms');

## Groups
Route::get('groups', 'Site\HomeController@groups')->name('groups');

## Activities
Route::get('activities', 'Site\HomeController@activities')->name('activities');

## Contact
Route::get('contact_us', 'Site\HomeController@contact')->name('contact_us');
Route::post('storeContact', 'Site\HomeController@storeContact')->name('storeContact');





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
