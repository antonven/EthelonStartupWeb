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
	    Route::get('/getallfoundations','FoundationController@getallfoundations');
		Route::post('/activitypoints','VolunteerController@points');				
		
		Route::post('/activitycriteria','ActivityController@criteria');
	
		
		Route::post('/activitygetvolunteersbefore','ActivityController@getVolunteersBefore');
		Route::post('/groupmatestorate','ActivityController@volunteersToRate');
		Route::post('/checkNotif','NotificationController@groupsController');
		
});
Route::post('/joinactivity','VolunteerController@joinActivity');
Route::post('/activitycriteria','ActivityController@criteria');
Route::post('/fcm_token','VolunteerController@fcm_token');
Route::post('/delete','TestingController@deleteall');
Route::post('/activitygetvolunteersbefore','ActivityController@getVolunteersBefore');
Route::post('/getallactivities','ActivityController@getActivitiesNotDone');	
Route::post('/portfolio','ActivityController@portfolio');
Route::post('/checkIfAlreadyAttended','VolunteerController@checkIfAlreadyAttended');
Route::get('/leaderboard','VolunteerController@leaderboard');
Route::post('/sendNotif','ActivityController@sendNotifications');	
Route::post('/rategroupmate','VolunteerController@rategroupmate');	
Route::post('/sendnotif','ActivityController@sendNotifications');
Route::post('/test','ActivityController@test');
Route::post('/loginwithfbnoemail','LoginController@loginwithFbnoEmail');
Route::post('/loginwithfb','LoginController@loginwithFb');
//Route::get('/deleteall','ActivityController@deleteall');
Route::post('/attendanceactivity','VolunteerController@successAttendance');
Route::post('/test2','ActivityController@test2');

Route::post('/test3','TestingController@test3');
Route::post('/register','RegistrationController@register');
Route::post('/login','LoginController@login');


Route::post('/kobedelete','TestingController@kobedelete');

Route::post('/test4','TestingController@runScheduler');
Route::post('/volunteerstorate','ActivityController@volunteersToRate');

Route::group(['middleware'=>'foundation'],function(){

});

Route::post('/picture','RegistrationController@addPhoto');
Route::post('/notif','NotificationController@getNofitications');
Route::post('/skillprac','TestingController@skill');







