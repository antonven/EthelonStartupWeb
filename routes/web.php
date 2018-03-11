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

//user
Route::get('/', 'UserController@index');

//autorized users
Route::middleware(['auth','verified'])->group(function () {

	//foundation
        //dashboard
    Route::get('/admin', 'DashboardController@index');
        //activity
    Route::get('/activity', 'ActivityController@index');
    Route::get('/activity/create', 'ActivityController@create');
    Route::post('/activity/store', 'ActivityController@store');
    Route::get('/activity/{id}', 'ActivityController@view');
    Route::get('/activity/edit/{id}', 'ActivityController@edit');
    Route::post('/activity/edit/{id}', 'ActivityController@update');
    Route::get('/activity/delete/{id}', 'ActivityController@delete');
        //portfolio
    Route::get('/portfolio/{id}', 'PortfolioController@index');
            //set user portfolio setting
    Route::post('/portfolio/setPortfolioSetting/{id}', 'PortfolioController@setPortfolioSetting');
            //create portfolio template
    Route::post('/portfolio/createTemplate', 'TemplateController@store');
    Route::post('/portfolio/checkTemplate', 'TemplateController@checkTemplate');
    Route::get('/portfolio/activate/{template_id}', 'TemplateController@activateTemplate');
        //volunteers
    Route::get('/volunteers', 'VolunteerController@index');
        //editor
    Route::get('/editor/{template_name}', 'EditorController@index');
    Route::post('/editor/upload/{template_id}', 'EditorController@upload');
    Route::post('editor/store/{template_id}', 'EditorController@store');
    Route::post('editor/load/{template_id}', 'EditorController@load');
        //profile
    Route::get('profile/{foundation_id}', 'ProfileController@index');

    //admin
    Route::get('/admin/foundationlist', 'FoundationController@foundationList');
    Route::get('/admin/activitylist', 'ActivityController@activityList');
    Route::get('/admin/verify/{id}', 'FoundationController@verifyFoundation');
});
Route::get('/{foundation_name}/portfolio', 'UserController@portfolioView');
Route::get('/foundations', 'UserController@foundationList');
Route::get('/{skill}', 'UserController@list');
Route::get('/activity/{id}', 'UserController@activityView');

Route::get('/webtest/{id}','ActivityController@webtest');
Route::get('test', 'DashboardController@test');