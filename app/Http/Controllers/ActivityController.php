<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Volunteerbeforeactivity;
use App\Volunteerafteractivity;
use App\Activity;
use app\Volunteeractivity;

class ActivityController extends Controller
{


	 public function inputSkills(Request $request){
    	
    	$skills = $request->input('skills');
    	$volunteer_id = $request->input('activity_id');

    	foreach ($skills as $skill) {
    		Activitiyskill::create([
    			'name'=>$skill, 	
    			'activity_id' => $volunteer_id
    			]);
    	}
    }

    //

	//get volunteers that said they will join
    public function getVolunteersBefore(Request $request){
    	$activity_id = $request->input('activity_id');

    	$volunteersBefore = Volunteerbeforeactivity::where('activity_id',$activity_id)->get();
    	return response()->json($volunteersBefore);
        
    }

    //get volunteers that joined and captured the qr code
    public function getVolunteersAfter(Request $request){
    	$activity_id = $request->input('activity_id');

    	$volunteersAfter = Volunteerafteractivity::where('activity_id',$activity_id)->get();
    	return response()->json($volunteersAfter);
    }

    //get activities nga not done
    public function getActivitiesNotDone(){

    	$activities = Activity::where('status',false)->get();
            
    	return response()->json($activities);
        
    }

    public function portfolio(Request $request){

        $activities =  \DB::table('activities')->select('*')->join('volunteeractivities','volunteeractivities.activity_id','=','activities.activity_id')->where('volunteeractivities.volunteer_id',$request->input('volunteer_id'))->get();


        return response()->json($activities);

    }

   
}
