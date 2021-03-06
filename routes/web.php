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

  Route::get('/users', 'UserController@index')->name('users.index');

  Route::get('/change_password', 'Auth\AuthController@change_password')->name('change_password.index');

  Route::post('/store_password', 'Auth\AuthController@store_password')->name('store_password.store');

  Route::resource('/category', 'CategoryController');


  Route::get('admin_news', 'NewsController@index_admin');

  Route::resource('/news', 'NewsController',['except' => [
    'index', 'show'
  ]]);

  Route::group(['middleware' => 'is_admin'], function(){

    Route::post('/users', 'UserController@store')->name('users.store');

    Route::get('/send_test_email/{name}/{password}/{mail}', 'MailController@send');

  });

});

Route::get('/login', 'Auth\AuthController@index')->name("login.index");

Route::post('/login', 'Auth\AuthController@login')->name("login.login");

Route::get('news/{news}', 'NewsController@show')->name('news.show');

Route::get('news/{sortby?}/{category?}/{onlyphoto?}/{search?}', 'NewsController@index')->name('news.index');

Route::get('test', 'NewsController@test');
