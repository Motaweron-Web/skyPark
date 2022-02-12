<?php
use Illuminate\Support\Facades\Route;

    Route::resource('client', 'ClientController');














  //==================================== Group ================================
    Route::resource('reservations', 'ReservationController');
    Route::resource('capacity', 'CapacityController');
    Route::get('capacity-anotherMonth', 'CapacityController@anotherMonth')->name('capacity.anotherMonth.index');
