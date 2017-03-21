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
    
    Route::post('/signup', [
        'uses' => 'UserController@postSignUp', 
        'as' => 'signup'
    ]);
    
    Route::post('/signin', [
        'uses' => 'UserController@postSignIn', 
        'as' => 'signin'
    ]);
    
    Route::get('/signadmin', [
        'uses' => 'UserController@getSignAdmin',
        'as' => 'signadmin',
    ]);
    
    Route::post('/admin', [
        'uses' => 'UserController@postAdmin', 
        'as' => 'admin'
    ]);
    
    Route::get('/logout', [
        'uses' => 'UserController@getLogout', 
        'as' => 'logout'
    ]);
    
    Route::get('/perfil', [
        'uses' => 'UserController@getPerfil',
        'as' => 'perfil',
        'middleware' => 'auth'
    ]);
    
    /*---------- Vistes admin ---------*/
    
    Route::get('/admin', [
        'uses' => 'UserController@getListNameASC',
        'as' => 'admin',
        'middleware' => 'auth'
    ]);
    
    Route::get('/admindsc', [
        'uses' => 'UserController@getListNameDSC',
        'as' => 'admindsc',
        'middleware' => 'auth'
    ]);
    
    Route::get('/dnidsc', [
        'uses' => 'UserController@getListDniDSC',
        'as' => 'dnidsc',
        'middleware' => 'auth'
    ]);
    
    Route::get('/dni', [
        'uses' => 'UserController@getListDniASC',
        'as' => 'dni',
        'middleware' => 'auth'
    ]);
    
    Route::get('/adreca', [
        'uses' => 'UserController@getListAdrecaASC',
        'as' => 'adreca',
        'middleware' => 'auth'
    ]);
    
    Route::get('/adrecadsc', [
        'uses' => 'UserController@getListAdrecaDSC',
        'as' => 'adrecadsc',
        'middleware' => 'auth'
    ]);
    
    Route::get('/pdf', [
        'uses' => 'UserController@getPdf',
        'as' => 'pdf',
        'middleware' => 'auth'
    ]);
    
    /*-- accions --*/
    
    Route::get('/usuari/{id}', [
        'uses' => 'UserController@getUsuari',
        'as' => 'usuari'
    ]);
    
    Route::get('/editar/{id}', [
        'uses' => 'UserController@editarUsuari',
        'as' => 'editar'
    ]);
    
    Route::get('/esborrar/{id}', [
        'uses' => 'UserController@destroyUsuari',
        'as' => 'esborrar',
        'middleware' => 'auth'
    ]);
    
    /*---------- Fi Vistes admin ---------*/
    
    Route::get('/account', [
       'uses' => 'UserController@getAccount',
        'as' => 'account',
        'middleware' => 'auth'
    ]);
    
    Route::post('/updateaccount', [
        'uses' => 'UserController@postSaveAccount',
        'as' => 'account.save'
    ]);
    
    Route::get('/userimage/{filename}', [
       'uses' => 'UserController@getUserImage',
        'as' => 'account.image'
    ]);
    
    Route::get('/dashboard', [
        'uses' => 'UserController@getDashboard',
        'as' => 'dashboard',
        'middleware' => 'auth'
    ]);
    
    Route::get('/account/{id}/esborrar', [
        'uses' => 'UserController@destroy',
        'as' => 'delete',
        'middleware' => 'auth'
    ]);

    Route::get('/downloadUserASC', [
        'uses' => 'UserController@getpdfpreview',
        'as' => 'pdfpreview',
        'middleware' => 'auth'
    ]);
    
    Route::get('/downloadUserDSC', [
        'uses' => 'UserController@getpdfpreview2',
        'as' => 'pdfpreview',
        'middleware' => 'auth'
    ]);
    
    Route::get('/downloadDniASC', [
        'uses' => 'UserController@getpdfpreviewDni',
        'as' => 'pdfpreview',
        'middleware' => 'auth'
    ]);
    
    
    Route::get('/downloadDniDSC', [
        'uses' => 'UserController@getpdfpreviewDni2',
        'as' => 'pdfpreview',
        'middleware' => 'auth'
    ]);
    
    Route::get('/downloadAdressASC', [
        'uses' => 'UserController@getpdfpreviewAdress',
        'as' => 'pdfpreview',
        'middleware' => 'auth'
    ]);
    
    Route::get('/downloadAdressDSC', [
        'uses' => 'UserController@getpdfpreviewAdress2',
        'as' => 'pdfpreview',
        'middleware' => 'auth'
    ]);
    
});