<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Volunteerskill;
use App\Activity;
use App\Volunteerbeforeactivity;
use App\Volunteerafteractivity;
use App\Http\Controllers\DB;
use App\Volunteeractivity;



class VolunteerController extends Controller
{


    //

    public function inputSkills(Request $request){
    	

        $arrays = array();
    	$volunteer_id = $request->input('volunteer_id');


        $i = 1;

       
        if($stringcount = $request->input('count')){
            $count = (int)$stringcount;

            for($i = 0; $i < $count; $i++){

                 array_push($arrays, $request->input('params'.$i));      
                  //return response()->json($request->input('params'.$i));
            }

            
            foreach($arrays as $value){

                 Volunteerskill::create([
                  'name' => $value,
                  'volunteer_id' => $volunteer_id 
                ]);      

            }

          }

          else{

            return "wtf";

          }

        return "Success";
    }

    //join activity nga wala pa nahitabo
    public function joinActivity(Request $request){

       $watch = Volunteerbeforeactivity::where('volunteer_id',$request->input('volunteer_id'))
                                       ->where('activity_id',$request->input('activity_id'))->get();

         if($watch->count()){

            $data = array("message"=>"Already Joined");
            return response()->json($data);
            
         }                                   
         else{

        	Volunteerbeforeactivity::create([

        		 'volunteer_id'=>$request->input('volunteer_id'),
        		 'activity_id'=>$request->input('activity_id'),
        		 
        		]);

            Volunteeractivity::create([
                 'volunteer_id'=>$request->input('volunteer_id'),
                 'activity_id'=>$request->input('activity_id'),
                 'status'=> false  
                ]);
            

            $data = array("message"=>"Success");

            return response()->json($data);
            
            }
    }

    public function successAttendance(Request $request){
      //see if naka attendance nabah siya
    $vol_activity = Volunteerafteractivity::where('volunteer_id',$request->input('volunteer_id'))
                                          ->where('activity_id',$request->input('activity_id'))->get();

     if($vol_activity->count()){

            $data = array("message"=>"Attended already");
            return response()->json($data);

     }else{

        	Volunteerafteractivity::create([

        		'volunteer_id'=>$request->input('volunteer_id'),
        		 'activity_id'=>$request->input('activity_id')

        		]);

             \DB::table('volunteeractivities')
                ->where('volunteer_id',$request->input('volunteer_id'))
                ->where('activity_id',$request->input('activity_id'))
                ->update(['status' => true]);

                
                   $sumOfPoints = 0;

            if($count = $request->input('count')){
                for($i = 0; $i<$count; $i++){

                    $skill = $request->input('params'.$i);
                    $sumOfPoints = points($skill,$sumOfPoints);

                }
            }
            
            $hours = $request->input('hours');
            $sumOfPoints = $sumOfPoints * $hours;
            $volunteer_points = Volunteer::where('volunteer_id',$request->input('volunteer_id'))->select('points')->first();

            $new_points = $volunteer_points->points + $sumOfPoints;

            Volunteer::where('volunteer_id',$request->input('volunteer_id'))->update(['points' => $new_points]);
            \DB::table('activities')->where('activity_id',$request->input('activity_id'))->update(['points_equivalent' => $sumOfPoints]);

            $data = array("message"=>"Success");

            return response()->json($data);
        }
         
    }

    public function points($skill, $sumOfPoints){


                    switch($skill){

                         case 'Environmental': $sumOfPoints = $sumOfPoints + 30;
                                      break;          
                         case 'Sports': $sumOfPoints = $sumOfPoints + 20;                       
                                      break;
                         case 'Culinary': $sumOfPoints = $sumOfPoints + 20;
                                      break;
                         case 'Medical': $sumOfPoints = $sumOfPoints + 40;
                                      break;
                         case 'Charity': $sumOfPoints = $sumOfPoints + 50;
                                      break;
                         case 'Livelihood': $sumOfPoints = $sumOfPoints + 50;
                                      break;
                         case 'Education': $sumOfPoints = $sumOfPoints + 40;
                                      break;
                         case 'Arts': $sumOfPoints = $sumOfPoints + 20;
                                      break;

                    }        

                    return $sumOfPoints;
      
    }


    //kuhaon ang activities nga wala pah na attendan sa volunteer* 
    public function getBeforeActivities(Request $request){

    	$volunteer_id = $request->input('volunteer_id');

    	$activitiesBefore = Volunteerbeforeactivity::where('volunteer_id',$volunteer_id)->get();

    	return response()->json($activitiesBefore);

    }

    //kuhaon ang activities nga na attendan nah sa volunteer
    public function getAfterActivities(Request $request){
    	$volunteer_id = $request->input('volunteer_id');

    	//return dd($volunteer_id);
    	$activitiesAfter = Volunteerafteractivity::where('volunteer_id',$volunteer_id)->get();

    	return response()->json($activitiesAfter);
    }

    public function leaderboard(){

        $volunteerLeaderboard = Volunteer::orderBy('points','desc')->get();

        return response()->json($volunteerLeaderboard);

    }  

    public function volunteeractivitycriteria(){
        
    }


}
