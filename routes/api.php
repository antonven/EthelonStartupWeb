<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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


Route::group(['middleware'=>'auth:api'],function(){

		Route::post('/volunteerskills','VolunteerController@inputSkills');	
				

		Route::post('/getactivitiesbefore','VolunteerController@getBeforeActivities');
		Route::post('/getactivitiesafter','VolunteerController@getAfterActivities');
		Route::get('/activitygetvolunteersafter','ActivityController@getVolunteersAfter');
		Route::get('/activitygetvolunteersbefore','ActivityController@getVolunteersBefore');
					
		Route::post('/attendanceactivity','VolunteerController@successAttendance');
	    Route::post('/portfolio','ActivityController@portfolio');
	    Route::get('/getallfoundations','FoundationController@getallfoundations');
		Route::post('/activitypoints','VolunteerController@points');
			
		Route::post('/joinactivity','VolunteerController@joinActivity');
		Route::get('/leaderboard','VolunteerController@leaderboard');
		Route::post('/activitycriteria','ActivityController@criteria');
		Route::post('/getallactivities','ActivityController@getActivitiesNotDone');	

});
	

Route::get('/test','ActivityController@test');
Route::post('/loginwithfbnoemail','LoginController@loginwithFbnoEmail');
Route::post('/loginwithfb','LoginController@loginwithFb');

Route::post('/register','RegistrationController@register');
Route::post('/login','LoginController@login');

Route::post('/session','LoginController@sessionwatch');

Route::group(['middleware'=>'foundation'],function(){

});

Route::post('/picture','RegistrationController@addPhoto');







