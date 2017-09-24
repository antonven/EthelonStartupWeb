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
use App\Activitygroup;
use App\Volunteergroup;
use App\Volunteercriteria;
use App\Volunteercriteriapoint;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Groupnotification;


  
class VolunteerController extends Controller
{


    //

    public function rategroupmate(Request $request){

    $vol_activity = Volunteeractivity::where('volunteer_id',$request->input('volunteer_id'))
                                          ->where('activity_id',$request->input('activity_id'))
                                          ->where('status',true)->get();

                                

  if($vol_activity->count()){

            $data = array("message"=>"Registered");
            return 'naka register naman ka bai';

     }else{

        $rate_result = $this->rate($request);


        return $rate_result;
     }

    
   }

   public function rate($request){

        $activity_group_id = $request->input('activitygroups_id');
        $volunteer_id = $request->input('volunteer_id');
        $volunteer_id_to_rate = $request->input('volunteer_id_to_rate');
        $activity_id = $request->input('activity_id');
        $count = $request->input('count');

        $errors = 0;

     for($i = 0; $i < $count; $i++){

        $criteria =  $request->input('criteriaParams'.$i);
        $rating = $request->input('ratingParams'.$i);

          $mate = Volunteercriteria::create([

                    'volunteer_id' => $volunteer_id_to_rate,
                    'actvity_id'=>$activity_id,
                    'activitygroups_id'=>$activity_group_id,
                    'sum_of_rating' => $rating,          
                    'criteria_name' => $criteria     
            ]);


            if($mate){

                    $volunteercriteriapoints = Volunteercriteriapoint::where('activity_id',$activity_id)
                                                         ->where('volunteer_id',$volunteer_id_to_rate)
                                                         ->where('criteria_name',$criteria)->first();
                       if($volunteercriteriapoints){

                                $total_points = $volunteercriteriapoints->total_points + $rating;   
                                $num_of_raters = $volunteercriteriapoints->no_of_raters + 1;
                                $average_points = $total_points / $num_of_raters;   

                                    $volunteercriteriapoints = \DB::table('volunteercriteriapoints')->where('activity_id',$activity_id)->where('volunteer_id',$volunteer_id_to_rate)
                                                         ->where('criteria_name',$criteria)
                                                         ->update(['total_points'=>$total_points,
                                                                   'no_of_raters'=>$num_of_raters,
                                                                   'average_points'=>$average_points]);
                                    if($volunteercriteriapoints){
                                          
                                       


                                    }else{
                                         $data = array("message"=>"Something's wrong");

                                         $errors++;
                                    }                     

                      }else{

                                $data = array("message"=>"Something's wrong");

                                $errors++;
                         }                             
                            
             }else{

              $data = array("message"=>"Something's wrong");

              $errors++;
             }
      }

      return "success";
   }

   
   public function successAttendance(Request $request){
  
  
             \DB::table('volunteeractivities')
                ->where('volunteer_id',$request->input('volunteer_id'))
                ->where('activity_id',$request->input('activity_id'))
                ->update(['status' => true]);

             $activity = Activity::where('activity_id',$request->input('activity_ids'))->first();
             
             $start_time = \Carbon\Carbon::parse($activity->start_time);   
             $end_time =   \Carbon\Carbon::parse($activity->end_time); 

             $numOfHours = $start_time->diffInHours($end_time);
                
                   $sumOfPoints = 0;


               $activity_skills = Activityskill::where('activity_id',$request->input('activity_id'))->get();
               
               foreach($activity_skills as $activity_skill){

                $skill = $activity_skill->name;
                $sumOfPoints = $this->points($skill,$sumOfPoints);

               }    

                         
            $sumOfPoints = $sumOfPoints * $numOfHours;

             \DB::table('volunteeractivities')
                ->where('volunteer_id',$request->input('volunteer_id'))
                ->where('activity_id',$request->input('activity_id'))
                ->update(['points' => $sumOfPoints]);

            $volunteer_points = Volunteer::where('volunteer_id',$request->input('volunteer_id'))->select('points')->first();

            $new_points = $volunteer_poinst->points + $sumOfPoints;

            Volunteer::where('volunteer_id',$request->input('volunteer_id'))->update(['points' => $new_points]);
            \DB::table('activities')->where('activity_id',$request->input('activity_id'))->update(['points_equivalent' => $sumOfPoints]);



            $data = array("result"=>"Good");
            return response()->json($data);            
            
        
         
    }


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

       $watch = Volunteeractivity::where('volunteer_id',$request->input('volunteer_id'))
                                  ->where('activity_id',$request->input('activity_id'))->get();

         if($watch->count()){

            $data = array("message"=>"Already Joined");
            return response()->json($data);
            
         }                                   
         else{

      
            Volunteeractivity::create([
                 'volunteer_id'=>$request->input('volunteer_id'),
                 'activity_id'=>$request->input('activity_id'),
                 'status'=> false  
                ]);
            

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
                         case 'Culinary': $sumOfPoints = $sumOfPoints + 40;
                                      break;
                         case 'Medical': $sumOfPoints = $sumOfPoints + 40;
                                      break;
                         case 'Charity': $sumOfPoints = $sumOfPoints + 50;
                                      break;
                         case 'Livelihood': $sumOfPoints = $sumOfPoints + 50;
                                      break;
                         case 'Education': $sumOfPoints = $sumOfPoints + 40;
                                      break;
                         case 'Arts': $sumOfPoints = $sumOfPoints + 40;
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

         $volunteerLeaderboard = \DB::table('volunteers')->select('users.name as name', 'volunteers.*')
                                                        ->join('users','users.user_id','=','volunteers.user_id')->orderBy('volunteers.points','desc')->get();

        return response()->json($volunteerLeaderboard);

    }  

    public function volunteeractivitycriteria(){
        
    }




}
