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

Route::get('/', function () {
    return view('Admin/success');
});

Route::get('/admin','Admin\AdminController@index');

Route::group(['prefix'=>'admin','namespace=>admin'],function (){
   Route::get('/','Admin\AdminController@index');
    Route::get('/login','Admin\AdminController@login');
    Route::get('/cook','Admin\AdminController@cook');
    Route::get('/dianfu','Admin\AdminController@dianfu');
    Route::get('/liuliang','Admin\AdminController@liuliang');
    Route::get('/zha','Admin\AdminController@zha');
    Route::get('/tj','Admin\AdminController@tj');
});