<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function (){
       return view('welcome'); 
    })->name('home');
    
    Route::get('principal', function() {
        return view('principal');
    });
    
    Route::get('welcome', function() {
        return view('welcome');
    });
    
    Route::get('admin', function() {
        return view('admin');
    });
});