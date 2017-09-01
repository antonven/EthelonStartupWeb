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
		
					
		Route::post('/attendanceactivity','VolunteerController@successAttendance');
	    
	    Route::get('/getallfoundations','FoundationController@getallfoundations');
		Route::post('/activitypoints','VolunteerController@points');
				
		Route::post('/joinactivity','VolunteerController@joinActivity');
		Route::get('/leaderboard','VolunteerController@leaderboard');
		Route::post('/activitycriteria','ActivityController@criteria');
		Route::post('/getallactivities','ActivityController@getActivitiesNotDone');	
		
		Route::post('/portfolio','ActivityController@portfolio');
		Route::post('/activitygetvolunteersbefore','ActivityController@getVolunteersBefore');

		Route::post('/groupmatestorate','ActivityController@volunteersToRate');
		Route::post('/rategroupmate','ActivityController@rategroupmate');
		
});
	

Route::post('/test','ActivityController@test');
Route::post('/loginwithfbnoemail','LoginController@loginwithFbnoEmail');
Route::post('/loginwithfb','LoginController@loginwithFb');
Route::get('/deleteall','ActivityController@deleteall');
Route::post('/test2','ActivityController@test2');
Route::post('/register','RegistrationController@register');
Route::post('/login','LoginController@login');

Route::post('/session','LoginController@sessionwatch');
Route::post('/volunteerstorate','ActivityController@volunteersToRate');

Route::group(['middleware'=>'foundation'],function(){

});

Route::post('/picture','RegistrationController@addPhoto');







