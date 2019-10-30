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
    Route::post('{id}/dispute', 'ReportController@dispute')->name('report.dispute');
});

//Rules Controller
Route::get('rules', 'RulesController@index')->name('rules.list');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/panel', [
        'uses' => 'AdminpanelController@index',
        'middleware' => ['auth', 'rbac:can,page.admin.panel']
    ]);
    Route::group(['prefix' => 'settings', 'middleware' => ['auth', 'rbac:can,page.settings']], function () {
        Route::get('/', 'SettingsController@index')->name('settings');
        Route::get('/servers', 'SettingsController@servers')->name('settings.servers');
        Route::get('/design', 'SettingsController@design')->name('settings.design');
        Route::get('/web', 'SettingsController@web')->name('settings.web');
        Route::get('/seo', 'SettingsController@seo')->name('settings.seo');
        Route::get('/donate', 'SettingsController@web')->name('settings.donate');
        Route::post('/update-menu-item', 'SettingsController@updateMenuItem')->name('settings.update.menu.item');
        Route::post('/get-menu-item', 'SettingsController@getMenuItem')->name('settings.get.menu.item');
        Route::post('/update-settings', 'SettingsController@updateSettings')->name('settings.update');
    });

    Route::get('/tools', [
        'uses' => 'ToolsController@index',
        'middleware' => ['auth', 'rbac:can,page.tools']
    ]);
});

//Helpers
//Route::get('d/{url}', 'FileController@download')->name('file.download');

//DEV
Route::get('dev', 'MainController@dev')->name('dev');
