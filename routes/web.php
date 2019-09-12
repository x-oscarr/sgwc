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
Route::post('profile/edit', 'UserController@edit')->name('profile.edit');
Route::get('user/list', 'UserController@list')->name('user.list');
Route::get('user/{id}', 'UserController@single')->name('user');
Route::get('steamid/{steamid}', 'UserController@steamid')->name('steamid');

// Rating Controller
Route::get('rating', 'RatingController@index')->name('rating');

//Report Controller
Route::any('report/add', 'ReportController@add')->name('report.add');
Route::get('report/list', 'ReportController@index')->name('report.list');
Route::get('report/my-reports', 'ReportController@myReports')->name('report.my-reports');
Route::get('report/punishments', 'ReportController@punishments')->name('report.punishments');
Route::get('report/{id}', 'ReportController@single')->name('report.single');
//Route::post('report/sort', 'ReportController@sort')->name('report.sort');

//Helpers
//Route::get('d/{url}', 'FileController@download')->name('file.download');

//DEV
Route::get('dev', 'MainController@dev')->name('dev');
