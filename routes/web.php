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
Route::get('/', function(){
    return view('tempo');
});

Route::get('/shut',function(){

	return 'kobe';

});

Route::get('/kobe',function(){
	
});

Route::post('/register','RegistrationController@register');