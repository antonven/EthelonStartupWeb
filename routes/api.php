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

		
});


Route::post('/loginwithfbnoemail','@LoginController@loginwithFbnoEmail');
Route::post('/joinactivity','VolunteerController@joinActivity');
Route::post('/getactivitiesbefore','VolunteerController@getBeforeActivities');
Route::post('/getactivitiesafter','VolunteerController@getAfterActivities');
Route::get('/activitygetvolunteersafter','ActvityController@getVolunteersAfter');
Route::get('/activitygetvolunteersbefore','ActvityController@getVolunteersBefore');
Route::post('/volunteerskills','VolunteerController@inputSkills');
Route::get('/getallactivities','ActivityController@getActivitiesNotDone');
Route::post('/attendanceactivity','VolunteerController@successAttendance');
Route::post('/portfolio','ActivityController@portfolio');
Route::post('/loginwithfb','LoginController@loginwithFb');
Route::post('/register','RegistrationController@register');
Route::get('/login','LoginController@session');
Route::post('/session','LoginController@sessionwatch');
Route::post('/kobe','ActivityController@prac');



Route::group(['middleware'=>'foundation'],function(){


//environmental -30
//sports - 20
//culinary -20
//medicine -40
//charity -50
//livelihood -50
//education -40
//arts -20

});

Route::post('/picture','RegistrationController@addPhoto');







