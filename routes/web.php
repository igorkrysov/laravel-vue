<?php

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
Route::group(['middleware' => 'is_auth'], function(){
  Route::get('/', function () {
      return view('welcome');
  })->name("start");

  Route::get('/logout', 'Auth\AuthController@logout')->name("login.logout");
});

Route::get('/login', 'Auth\AuthController@index')->name("login.index");

Route::post('/login', 'Auth\AuthController@login')->name("login.login");
