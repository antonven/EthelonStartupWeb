<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware'=>'volunteer'],function(){

	Route::post('/volunteerskills','VolunteerController@inputSkills');
	Route::post('/joinactivity','VolunteerController@joinActivity');
	

	Route::post('/getactivitiesbefore','VolunteerController@getBeforeActivities');
	Route::post('/getactivitiesafter','VolunteerController@getAfterActivities');
	

	Route::get('/activitygetvolunteersafter','ActvityController@getVolunteersAfter');
	Route::get('/getallactivities','ActivityController@getActivitiesNotDone');
	Route::get('/activitygetvolunteersbefore','ActvityController@getVolunteersBefore');

});

Route::post('/attendanceactivity','VolunteerController@successAttendance');
Route::post('/portfolio','ActivityController@portfolio');
Route::post('/loginwithfb','LoginController@loginwithFb');
Route::post('/register','RegistrationController@register');
Route::get('/login','LoginController@login');


Route::group(['middleware'=>'foundation'],function(){

	
});

Route::post('/picture','RegistrationController@addPhoto');







