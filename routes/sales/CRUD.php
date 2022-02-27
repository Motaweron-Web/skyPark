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

    //==================================== Group ================================
         Route::resource('familyAccess', 'FamilyAccessController');





  //==================================== Group ================================
    Route::resource('reservations', 'ReservationController');
    Route::resource('capacity', 'CapacityController');
    Route::resource('groupAccess', 'GroupAccessController');
    Route::get('capacity-anotherMonth', 'CapacityController@anotherMonth')->name('capacity.anotherMonth.index');
    Route::POST('getBracelets', 'GroupAccessController@getBraceletsTwo')->name('capacity.getBracelets');





    //=========================== visitor Types Prices ============================
    Route::get('visitorTypesPrices','VisitorTypesPricesController@visitorTypesPrices')->name('visitorTypesPrices');


    #################################### Exit =======================================
        Route::resource('exit','ExitController');
