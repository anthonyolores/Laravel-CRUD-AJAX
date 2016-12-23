<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('master');
});

Route::group(['middleware' => ['web']], function() {
  Route::get('/all','RegisterController@Index');
  Route::post( '/addItem', 'RegisterController@addItem' );
  Route::post( '/deleteItem', 'RegisterController@deleteItem' );
  Route::post( '/updateItem', 'RegisterController@updateItem' );
});
