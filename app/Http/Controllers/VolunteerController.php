<?php
namespace App\Http\Controllers;
ini_set("memory_limit","1000M");

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
use App\Volunteerbadge;
use App\Groupnotification;


  
class VolunteerController extends Controller
{


    //

    public function fcm_token(Request $request){

      if($request->input('fcm_token') == null){

      }else{

        Volunteer::where('volunteer_id',$request->input('volunteer_id'))
                  ->update(['fcm_token'=>$request->input('fcm_token')]);

                  $data = array("data"=>"success");

                  return response()->json($data);
      }

      
    }
     public function checkIfAlreadyAttended(Request $request){
    $vol_activity = Volunteeractivity::where('volunteer_id',$request->input('volunteer_id'))
                                          ->where('activity_id',$request->input('activity_id'))
                                          ->where('status',true)->get();
        if($vol_activity->count()){

          $data = array("message"=>"Registered");
          return response()->json($data);

        }else{

           $data = array("message"=>"Not Registered");
           return response()->json($data);

        }                                  


   }


    public function rategroupmate(Request $request){

    $vol_activity = Volunteeractivity::where('volunteer_id',$request->input('volunteer_id'))
                                          ->where('activity_id',$request->input('activity_id'))
                                          ->where('status',true)->get();

                                

  if($vol_activity->count()){

            $data = array("message"=>"Registered");
            return response()->json($data);

     }else{

        $rate_result = $this->rate($request);

        $data = array("message"=>"Success");
        return response()->json($data);;
     }

    
   }

  
   public function rate($request){

        $activity_group_id = $request->input('activitygroups_id');
        $volunteer_id = $request->input('volunteer_id');
        $volunteer_id_to_rate = $request->input('volunteer_id_to_rate');
        $activity_id = $request->input('activity_id');
        $count = $request->input('count');
        $errors = 0;
        $data = array("message"=>"Something's wrong");

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

                                     $group = Activitygroup::where('id',$activity_group_id)->first();

                                      if($num_of_raters == $group->numOfVolunteers){

                                          $volunteer = Volunteer::where('volunteer_id',$volunteer_id_to_rate)->first();
                                          $points = $average_points + $volunteer->points;

                                          Volunteer::where('volunteer_id',$volunteer_id_to_rate)
                                                    ->update(['points'=>$points]);

                                      }                    

                                    if($volunteercriteriapoints){
                                          $data = array("message"=>"Success");
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
      return response()->json($data);
   }


   public function badgePercentage($volunteerBadge){

    $equivalentPercentage = 0;

      switch($volunteerBadge){
          case 'Newbie':
            $equivalentPercentage = 0.5;
            # code...
            break;

          case "Archon":
            $equivalentPercentage = 0.4;
            break;

          case "Expert":
            $equivalentPercentage = 0.3;
            break;

          case "Legend":
            $equivalentPercentage = 0.2;
            break;

      }
      return $equivalentPercentage;
   }


   public function updateBadge($volunteerBadge, $gauge_points){

      switch($volunteerBadge->badge) {
        case 'Newbie':
         Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
          ->where('badge', 'Newbie')->update(['badge'=>'Archon','gauge_points'=>$gauge_points,'points'=>0]);
          break;
        
        case 'Archon':
          Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
          ->where('badge', 'Archon')->update(['badge'=>'Expert','gauge_points'=>$gauge_points,'points'=>0]);
          break;

        case 'Expert':
          Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
          ->where('badge', 'Expert')->update(['badge'=>'Legend','gauge_points'=>$gauge_points,'points'=>0]);
          break;

      }

   }


   public function updateStar($volunteerBadge, $received_gauge_points){
    switch ($volunteerBadge->star) {

      
        case 0:
        $new_gauge_points = ($volunteerBadge->gauge_points + $received_gauge_points) - 100;
        Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
          ->where('star', 0)->update(['star'=>1, 'points'=>0, 'gauge_points'=>$new_gauge_points]);
        # code...
        break;
        case 1:
        Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
          ->where('star', 1)->update(['star'=>2, 'points'=>0, 'gauge_points'=>$new_gauge_points]);
        # code...
        break;
        case 2:
        Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
          ->where('star', 2)->update(['star'=>3, 'points'=>0, 'gauge_points'=>$new_gauge_points]);
        # code...
        break;
        case 3:
        Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
          ->where('star', 3)->update(['star'=>4, 'points'=>0, 'gauge_points'=>$new_gauge_points]);
        # code...
        break;
        case 4:
        Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
          ->where('star', 4)->update(['star'=>5, 'points'=>0, 'gauge_points'=>$new_gauge_points]);
        # code...
        break;
          
    }


   }

   
   public function successAttendance(Request $request){
  
  
             \DB::table('volunteeractivities')
                ->where('volunteer_id',$request->input('volunteer_id'))
                ->where('activity_id',$request->input('activity_id'))
                ->update(['status' => true]);
                

             $activity = Activity::where('activity_id',$request->input('activity_id'))->first();
             
             $start_time = \Carbon\Carbon::parse($activity->start_time);   
             $end_time =   \Carbon\Carbon::parse($activity->end_time); 
             $criteria = Volunteercriteriapoint::where('activity_id', $request->input('actvity_id'))
             ->where('volunteer_id', $request->input('volunteer_id'))->get()

               $criteriaTotal = 0;
               $sumOfPoints = 0;

               $activity_skills = Activityskill::where('activity_id',$request->input('activity_id'))->get();
               $volunteer = Volunteer::where('volunteer_id', $request->input('volunteer_id'))->first();
               $volunteerBadges = Volunteerbadge::where('volunteer_id', $request->input('volunteer_id'))->get();
               
  
               foreach ($criteria as $criterion) {
                    
                    $criteriaTotal = $criteriaTotal + $criterion->average_points;

                 # code...
               }
                $activity_points = $criteriaTotal + $activity->points_equivalent;
                $total_points = $activity_points + $volunteer->points;

               foreach ($activity_skills as $activity_skill) {
                  foreach ($volunteerBadges as $volunteerBadge) {
                    # code...
                    if(strcmp($activity_skill, $volunteerBadge->skill) == 0){
                       
                      $skill_points_local = $volunteerBadge->points + $activity_points;
                      $gauge_points = $skill_points_local * $this->badgePercentage($volunteerBadge->badge);

                        if($gauge_points >= 100){

                              if($volunteerBadge->star == 5){
                                $this->updateBadge($volunteerBadge, $gauge_points);
                              }
                              else{
                                $this->updateStar($volunteerBadge, $gauge_points);
                              }
                        }
                        else{
                           Volunteerbadge::where('volunteer_id', $request->input('volunteer_id'))
                              ->where('badge', $volunteerBadge->badge)
                              ->update(['gauge_points'=>$gauge_points, 'points'=>$skill_points_local]);
                        }
                       
                    }
                  }
                 # code...
               }
              
               


            $sumOfPoints = $sumOfPoints + $activity->points_equivalent;

             \DB::table('volunteeractivities')
                ->where('volunteer_id',$request->input('volunteer_id'))
                ->where('activity_id',$request->input('activity_id'))
                ->update(['points' => $sumOfPoints]);

            $volunteer_points = Volunteer::where('volunteer_id',$request->input('volunteer_id'))->select('points')->first();

            $new_points = $volunteer_points->points + $sumOfPoints;

    