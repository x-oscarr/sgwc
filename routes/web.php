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
Route::group(['prefix' => 'report'], function () {
    Route::get('/', 'ReportController@index')->name('report.list');
    Route::any('add', 'ReportController@add')->name('report.add');
    Route::get('my-reports', 'ReportController@myReports')->name('report.my-reports');
    Route::get('my-violations', 'ReportController@myViolations')->name('report.my-violations');
    Route::get('{id}', 'ReportController@single')->name('report.single');
    Route::get('panel', ['uses' => 'ReportController@adminpannel', 'middleware' => 'site.module:report'])->name('report.panel');
});

//Rules Controller
Route::get('rules', 'RulesController@index')->name('rules.list');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/panel', [
        'uses' => 'Adminpanel@index',
        'middleware' => ['auth', 'rbac:can,page.admin.panel']
    ]);
    Route::get('/settings', [
        'uses' => 'Settings@index',
        'middleware' => ['auth', 'rbac:can,page.settings']
    ]);
    Route::get('/tools', [
        'uses' => 'Tools@index',
        'middleware' => ['auth', 'rbac:can,page.tools']
    ]);
});

//Helpers
//Route::get('d/{url}', 'FileController@download')->name('file.download');

//DEV
Route::get('dev', 'MainController@dev')->name('dev');
