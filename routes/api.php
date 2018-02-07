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

		//activity
		Route::post('/joinactivity','VolunteerController@joinActivity');
		Route::post('/activitycriteria','ActivityController@criteria');
		Route::post('/portfolio','ActivityController@portfolio');
		Route::post('/getallactivities','ActivityController@getActivitiesNotDone');	
		Route::post('/activitygetvolunteersbefore','ActivityController@getVolunteersBefore');
		Route::get('/activitygetvolunteersafter','ActivityController@getVolunteersAfter');
		Route::post('/activitycriteria','ActivityController@criteria');
		

		//volunteer
		Route::post('/volunteerstorate','ActivityController@volunteersToRate');
		Route::post('/checkIfAlreadyAttended','VolunteerController@checkIfAlreadyAttended');
		
		Route::post('/rategroupmate','VolunteerController@rategroupmate');	
		
		Route::post('/volunteerskills','VolunteerController@inputSkills');	
		Route::post('/activitypoints','VolunteerController@points');
			

		//foundations
		Route::get('/getallfoundations','FoundationController@getallfoundations');
		

		//notification
		Route::post('/notif','NotificationController@getNofitications');
		Route::post('/sendNotif','ActivityController@sendNotifications');	
		Route::post('/getnumofnotifs','NotificationController@numOfUnread');
		Route::post('/notiftabclicked','NotificationController@notificationTabClicked');
		Route::post('/checkNotif','NotificationController@groupsController');
		
		//login
		

		//get fcm token 
		
		
		
	    Route::post('/picture','RegistrationController@addPhoto');
					
		
		
});


Route::group(['middleware'=>'foundation'],function(){

});

Route::post('/fcm_token','VolunteerController@fcm_token');
Route::post('/groupmatestorate','ActivityController@volunteersToRate');
Route::post('/attendanceactivity','VolunteerController@successAttendance');
Route::get('/leaderboard','VolunteerController@leaderboard');
Route::post('/volunteerprofile','VolunteerController@volunteerProfile');

//testingge

Route::post('/notificationClicked','NotificationController@notificationClicked');
Route::post('/skillprac','TestingController@skill');
Route::post('/test2','TestingController@test2');
Route::post('/test3','TestingController@test3');
Route::post('/test','ActivityController@test');
Route::post('/test4','TestingController@runScheduler');
Route::post('/kobedelete','TestingController@kobedelete');
Route::post('/delete','TestingController@deleteall');
Route::post('/scheduler','SchedulerColler@runScheduler');
Route::post('/register','RegistrationController@register');
Route::post('/login','LoginController@login');
Route::post('/loginwithfbnoemail','LoginController@loginwithFbnoEmail');
Route::post('/loginwithfb','LoginController@loginwithFb');
Route::post('/groupmatestorate','ActivityController@volunteersToRate');
Route::post('/getSkills','VolunteerController@getSkills');

Route::post('/profileDetails','VolunteerController@profileDetails');


