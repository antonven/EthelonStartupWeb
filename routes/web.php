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
Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/activity', 'ActivityController@index');
    Route::get('/activity/create', 'ActivityController@create');
    Route::post('/activity/store', 'ActivityController@store');
    Route::get('/admin/foundationlist', 'FoundationController@foundationList');
    Route::get('/admin/activitylist', 'ActivityController@activityList');
    Route::get('/admin/verify/{id}', 'FoundationController@verifyFoundation');
});
Route::get('/webtest/{id}','ActivityController@webtest');
Route::get('test', 'DashboardController@test');