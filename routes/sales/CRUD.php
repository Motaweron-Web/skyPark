<?php
use Illuminate\Support\Facades\Route;

    Route::resource('client', 'ClientController');














  //==================================== Group ================================
    Route::resource('reservations', 'ReservationController');
    Route::resource('capacity', 'CapacityController');
    Route::resource('groupAccess', 'GroupAccessController');
    Route::get('capacity-anotherMonth', 'CapacityController@anotherMonth')->name('capacity.anotherMonth.index');





    //=========================== visitor Types Prices ============================
    Route::get('visitorTypesPrices','VisitorTypesPricesController@visitorTypesPrices')->name('visitorTypesPrices');
