<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Volunteerbeforeactivity;
use App\Volunteerafteractivity;
use App\Activity;
use App\Volunteeractivity;
use App\Volunteerskill;
use App\Activityskill;
use App\User;
use App\Events\HelloPusherEvent;
use App\Volunteer;
use App\Activitycriteria;
use Carbon\Carbon;
use App\Foundation;
use App\Activitygroup;
use App\Volunteergroup;
use App\Volunteercriteria;
use App\Volunteercriteriapoint;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Volunteerbadge;
use App\Groupnotification;
use App\Badge;


class ChartController extends Controller
{
    //

    public function getPercentOfAbsents($id){

    	
    		$Totalcount = Volunteeractivity::where('activity_id',$id)->get()->count();
    		$absentCount = Volunteeractivity::where('activity_id',$id)->where('status',false)->get()->count();

    		if($Totalcount != 0 || $absentCount != 0){
    				$percentOfAbsents = ($absentCount / $Totalcount) * 100;
    				$percentOfPresent = 100 - $percentOfAbsents;

    				echo $percentOfAbsents;
    		}else{

    			//returni lag 0 ang percentage sa duha 
    		}
    		
    }

    public function getAge($id){
    	$id = $request->input('id');


    	$ages = \DB::table('volunteers')->select('volunteers.age',\DB::raw('count(*) as user_count, volunteers.age'))->join('volunteeractivities','volunteeractivities.volunteer_id','=','volunteers.volunteer_id')->where('volunteeractivities.activity_id',$id)->groupBy('volunteers.age')->get();

    	//sud sa ages kay ang age nya pila kabouk kana nga age

    	return response()->json($ages);

    }

   public function getNumberOfVolunteerSkills(Request $request){

   	//taya ikaw lay query diri franz kuhaon niya ang number of volunteer nga ni match ana nga skill sa activity

   	/*	$id = $request->input('id');

   		$activity = Activity::where('activity_id',$id)->first();
   		$actskills = $activity->skills;

   	$volunteersMatch = Volunteer::whereHas('volunteerSkills',function($query) use ($actskills){
                                                     $query->whereIn('name',$actskills);
                                             })->whereHas('activitiesJoined',function($query2)use ($activity){
                                                     $query2->whereIn('activity_id',$activity);
                                             })->groupBy('volunteerSkills.name',function($query3)use ($actskills){
                                             		$query3->whereIn('name',$actskills);
                                             })->get();

                                             return response()->json($volunteersMatch);

   

   		$data = \DB::table('volunteerskills')->select('activityskills.name',\DB::raw('count(*) as user_count, activityskills.name'))
   											->join('volunteeractivities','volunteeractivities.volunteer_id','=','volunteerskills.volunteer_id')
   											->join('activityskills','activityskills.name','=','volunteerskills.name')
   											->where('volunteeractivities.activity_id',$id)
   											->groupBy('activityskills.name')->get();*/



   		//return response()->json($data);


   }

   public function getExp(Request $request){

   	$id = $request->input('id');

   	$exp = \DB::table('volunteers')->select('volunteers.points',\DB::raw('count(*) as user_count, volunteers.points'))->join('volunteeractivities','volunteeractivities.volunteer_id','=','volunteers.volunteer_id')->where('volunteeractivities.activity_id',$id)->groupBy('volunteers.points')->get();


   	return response()->json($exp);

   }

   public function getRating(Request $request){
   	$id = $request->input('id');

   	$sd = \DB::table('volunteercriteriapoints')->select('volunteercriteriapoints.criteria_name',\DB::raw('SUM(volunteercriteriapoints.average_points) as average_points'),\DB::raw('count(*) as user_count, volunteercriteriapoints.average_points'))->where('volunteercriteriapoints.average_points','>',0)->where('volunteercriteriapoints.activity_id',$id)->groupBy('volunteercriteriapoints.criteria_name')->get();



   	//pang butangi lang og if sa blade franz if walay sud kay 0 lang sa 
   	//return response()->json($sd);

   }

}
