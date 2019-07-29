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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'MainController@index')->name('index');;

// Auth Controller
Route::get('auth', 'AuthController@handle')->name('auth');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// User Controller
Route::get('profile', 'UserController@index')->name('profile');
Route::get('profile/edit', 'UserController@edit')->name('profile.edit');
Route::get('user/{id}', 'UserController@single')->name('user');

//DEV
Route::get('dev/', 'MainController@dev')->name('dev');
