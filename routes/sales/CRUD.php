<?php

use Illuminate\Support\Facades\Route;

    //==================================== Family ================================
    Route::resource('client', 'ClientController');
    Route::get('client-search', 'ClientController@search')->name('client.search');

    // Ticket
    Route::resource('ticket', 'TicketController');
    Route::get('calcCapacity', 'TicketController@calcCapacity')->name('calcCapacity');
    Route::POST('storeModels', 'TicketController@storeModels')->name('storeModels');
    Route::POST('storeRevTicket', 'ReservationController@storeRevTicket')->name('storeRevTicket');

    // Reservation
    Route::get('searchForReservations', 'ReservationController@searchForReservations')->name('searchForReservations');
    Route::POST('delete_reservation', 'ReservationController@delete_reservation')->name('delete_reservation');
    Route::POST('update_reservation', 'ReservationController@update_reservation')->name('update_reservation');
    Route::get('editReservation/{id}', 'ReservationController@editReservation')->name('editReservation');
    Route::get('detailsReservation/{id}', 'ReservationController@detailsReservation')->name('detailsReservation');



    //==================================== Group ================================
    Route::resource('familyAccess', 'FamilyAccessController');


    //==================================== Group ================================
    Route::resource('reservations', 'ReservationController');
    Route::resource('capacity', 'CapacityController');
    Route::resource('groupAccess', 'GroupAccessController');
    Route::get('capacity-anotherMonth', 'CapacityController@anotherMonth')->name('capacity.anotherMonth.index');
    Route::POST('getBracelets', 'GroupAccessController@getBraceletsTwo')->name('capacity.getBracelets');


    #################################### Exit =======================================
    Route::resource('exit', 'ExitController');
    Route::get('exit-{search}', 'ExitController@all')->name('exit-all');



//    ############################ print  /////////////////////////////////
//        Route::get('reservations')
