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
	

	Route::post('/attendanceactivity','VolunteerController@successAttendance');
	Route::post('/getactivitiesbefore','VolunteerController@getBeforeActivities');
	Route::post('/getactivitiesafter','VolunteerController@getAfterActivities');
	
	
});

Route::get('/getallactivities','ActivityController@getActivitiesNotDone');
Route::post('/loginwithfb','LoginController@loginwithFb');
Route::post('/register','RegistrationController@register');
Route::get('/login','LoginController@login');


Route::group(['middleware'=>'foundation'],function(){

	//get activity's volunteers nga mo join daw  
	Route::get('/activitygetvolunteersbefore','ActvityController@getVolunteersBefore');
	
	//get activity's volunteers nga ni pass sa ila attendance
	Route::get('/activitygetvolunteersafter','ActvityController@getVolunteersAfter');
	
});

Route::post('/picture','RegistrationController@addPhoto');







