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


  
class VolunteerController extends Controller
{


    //




    public function getSkills(Request $request){
        $volunteer_id = $request->input('volunteer_id');

        $skills = Volunteerskill::select("name")->where('volunteer_id',$volunteer_id)->get();

        return response()->json($skills);
    }

    public function getFoundationProfile(Request $request){

        $foundation = Foundation::where('foundation_id',$request->input('foundation_id'))->first();


        return response()->json($foundation);
    }

    public function profileDetails(Request $request){

       $volunteer_id = $request->input('volunteer_id');

       $vol = Volunteer::select('volunteers.image_url','users.name','users.email')
                         ->join('users','users.user_id','=','volunteers.user_id')
                         ->where('volunteer_id',$request->input('volunteer_id'))
                         ->get();


      $skills = Volunteerskill::select("name")->where('volunteer_id',$volunteer_id)->get();

      $details = array("details"=>$vol,"skills"=>$skills);

                return response()->json($details);         
    }

    public function volunteerProfile(Request $request){

      $volunteer_id = $request->input('volunteer_id');

      $infos = Volunteerbadge::select('volunteerbadges.*','badges.url as url','badges.*')
                              ->join('badges',function($join){
                                $join->on('badges.badge','=','volunteerbadges.badge')
                                    ->on('badges.skill','=','volunteerbadges.skill');
                              })->where('volunteerbadges.volunteer_id','=',$volunteer_id)->get();

           $infoBadges = array(); 


      foreach($infos as $info){
         
      /*$badges = Volunteerbadge::select('volunteerbadges.*','badges.url as url','badges.*')
                              ->join('badges',function($join){
                                $join->on('badges.skill','=','volunteerbadges.skill');
                              })->where('volunteerbadges.skill','=',$info->skill)->get();*/

                       $badges = Badge::where('skill',$info->skill)->get();

                       $points = ($info->star*$this->getGauge($info->badge)) +$info->points;
                       $percentCompleted = ($points/($this->getGauge($info->badge)*6))*100;        

                 $infoBadge = array("info"=>$info,"percentCompleted"=>$percentCompleted,"badges"=>$badges);
                 array_push($infoBadges,$infoBadge);  



      }

                              return response()->json($infoBadges);

    } 

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

            

            $data = array("message"=>"Success");
            return response()->json($data);;
         }

    
   }

  
   public function rate($request){

        $setting = \DB::table('settings')->first();
        

        $activity_group_id = $request->input('activitygroups_id');
        $volunteer_id = $request->input('volunteer_id');
        $volunteer_id_to_rate = $request->input('volunteer_id_to_rate');
        $activity_id = $request->input('activity_id');
        $count = $request->input('count');
        $errors = 0;
        $data = array("message"=>"Something's wrong");

        $activity_skills = Activityskill::where('activity_id',$activity_id)->get();

        foreach($activity_skills as $activity_skill){

          $volunteerbadge = Volunteerbadge::where('volunteer_id',$volunteer_id)
                        ->where('skill',$activity_skill->name)
                        ->first();

          $additional5PointsForRating = $volunteerbadge->points + $setting->activityPointsPerRating;

           Volunteerbadge::where('volunteer_id',$volunteer_id)
                        ->where('skill',$activity_skill->name)
                        ->update(['points'=>$additional5PointsForRating]);               
        }

        
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

      switch($volunteerBadge->badge){
          case 'Nothing': $equivalentPercentage = 0.5;
           $atay =  Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
            ->where('badge', 'Nothing')
            ->where('skill',$volunteerBadge->skill)  
            ->update(['badge'=>'Newbie']);  
            
            break;   

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


   public function updateBadge($volunteerBadge, $newVolunteerBadgePoints){

      switch($volunteerBadge->badge) {
        case 'Newbie':
         Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
          ->where('badge', 'Newbie')
          ->where('skill',$volunteerBadge->skill)->update(['badge'=>'Explorer','points'=>$newVolunteerBadgePoints,'star'=>0]);

        $newVolunteerBadge = Volunteerbadge::select('volunteerbadges.*','badges.url as url','badges.*')
                              ->join('badges',function($join){
                                $join->on('badges.badge','=','volunteerbadges.badge')
                                    ->on('badges.skill','=','volunteerbadges.skill');
                              })->where('volunteerbadges.volunteer_id','=',$volunteerBadge->volunteer_id)
                                ->where('volunteerbadges.skill',$volunteerBadge->skill)
                                ->first();
                                            return $newVolunteerBadge;//return new badge

          break;
        
        case 'Explorer':
          Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
          ->where('skill',$volunteerBadge->skill) 
          ->where('badge', 'Explorer')->update(['badge'=>'Expert','points'=>$newVolunteerBadgePoints,'star'=>0]);

          $newVolunteerBadge = Volunteerbadge::select('volunteerbadges.*','badges.url as url','badges.*')
                              ->join('badges',function($join){
                                $join->on('badges.badge','=','volunteerbadges.badge')
                                    ->on('badges.skill','=','volunteerbadges.skill');
                              })->where('volunteerbadges.volunteer_id','=',$volunteerBadge->volunteer_id)
                              ->where('volunteerbadges.skill',$volunteerBadge->skill)
                              ->first();
                                            return $newVolunteerBadge;//return new badge
          break;

        case 'Expert':
          Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
          ->where('skill',$volunteerBadge->skill) 
          ->where('badge', 'Expert')->update(['badge'=>'Legend','points'=>$newVolunteerBadgePoints,'star'=>0]);

          $newVolunteerBadge = Volunteerbadge::select('volunteerbadges.*','badges.url as url','badges.*')
                              ->join('badges',function($join){
                                $join->on('badges.badge','=','volunteerbadges.badge')
                                    ->on('badges.skill','=','volunteerbadges.skill');
                              })->where('volunteerbadges.volunteer_id','=',$volunteerBadge->volunteer_id)
                              ->where('volunteerbadges.skill',$volunteerBadge->skill)
                              ->first();
                                            return $newVolunteerBadge;//return new badge
          break;

      }

   }

                                                          
   public function updateStar($volunteerBadge, $newVolunteerBadgePoints){
    switch ($volunteerBadge->star) {

      
        case 0:
        Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
          ->where('star', 0)->where('skill',$volunteerBadge->skill)->update(['star'=>1, 'points'=>$newVolunteerBadgePoints]);

          $newVolunteerBadge = Volunteerbadge::select('volunteerbadges.*','badges.url as url','badges.*')
                              ->join('badges',function($join){
                                $join->on('badges.badge','=','volunteerbadges.badge')
                                    ->on('badges.skill','=','volunteerbadges.skill');
                              })->where('volunteerbadges.volunteer_id','=',$volunteerBadge->volunteer_id)
                                ->where('volunteerbadges.skill',$volunteerBadge->skill)->first();

                  return $newVolunteerBadge;            
        
        break;

        case 1:
        Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
          ->where('star', 1)->where('skill',$volunteerBadge->skill)->update(['star'=>2, 'points'=>$newVolunteerBadgePoints]);

         $newVolunteerBadge = Volunteerbadge::select('volunteerbadges.*','badges.url as url','badges.*')
                              ->join('badges',function($join){
                                $join->on('badges.badge','=','volunteerbadges.badge')
                                    ->on('badges.skill','=','volunteerbadges.skill');
                              })->where('volunteerbadges.volunteer_id','=',$volunteerBadge->volunteer_id)
                                ->where('volunteerbadges.skill',$volunteerBadge->skill)->first();

                  return $newVolunteerBadge;
       
        break;

        case 2:
        Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
          ->where('star', 2)->where('skill',$volunteerBadge->skill)->update(['star'=>3, 'points'=>$newVolunteerBadgePoints]);

           $newVolunteerBadge = Volunteerbadge::select('volunteerbadges.*','badges.url as url','badges.*')
                              ->join('badges',function($join){
                                $join->on('badges.badge','=','volunteerbadges.badge')
                                    ->on('badges.skill','=','volunteerbadges.skill');
                              })->where('volunteerbadges.volunteer_id','=',$volunteerBadge->volunteer_id)
                                ->where('volunteerbadges.skill',$volunteerBadge->skill)->first();

                  return $newVolunteerBadge;
        
        break;

        case 3:
        Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
          ->where('star', 3)->where('skill',$volunteerBadge->skill)->update(['star'=>4, 'points'=>$newVolunteerBadgePoints]);

          $newVolunteerBadge = Volunteerbadge::select('volunteerbadges.*','badges.url as url','badges.*')
                              ->join('badges',function($join){
                                $join->on('badges.badge','=','volunteerbadges.badge')
                                    ->on('badges.skill','=','volunteerbadges.skill');
                              })->where('volunteerbadges.volunteer_id','=',$volunteerBadge->volunteer_id)
                                ->where('volunteerbadges.skill',$volunteerBadge->skill)->first();

                  return $newVolunteerBadge;
        
        break;

        case 4:
        Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
          ->where('star', 4)->where('skill',$volunteerBadge->skill)->update(['star'=>5, 'points'=>$newVolunteerBadgePoints]);

           $newVolunteerBadge = Volunteerbadge::select('volunteerbadges.*','badges.url as url','badges.*')
                              ->join('badges',function($join){
                                $join->on('badges.badge','=','volunteerbadges.badge')
                                    ->on('badges.skill','=','volunteerbadges.skill');
                              })->where('volunteerbadges.volunteer_id','=',$volunteerBadge->volunteer_id)
                                ->where('volunteerbadges.skill',$volunteerBadge->skill)->first();

                  return $newVolunteerBadge;
        
        break;
          
    }


   }

   public function getGauge($badge){
    $setting = \DB::table('settings')->first();

    switch ($badge) {

      case "Nothing":
          return $setting->newbieGauge;
          break;

        case "Newbie":
          return $setting->newbieGauge;
          break;

        case "Explorer":
          return $setting->explorerGauge;
          break;

        case "Expert":
          return $setting->expertGauge;
          break;

        case "Legend":
          return $setting->legendGauge;
          break;  

    }

   }

   public function qrPicture(Request $request){


      $volunteeractivity =  \DB::table('volunteeractivities')
                ->where('volunteer_id',$request->input('volunteer_id'))
                ->where('activity_id',$request->input('activity_id'))
                ->first();


    if($volunteeractivity->volunteerTimedIn == false){

      
      //$sd = Carbon::instance($now);

            \DB::table('volunteeractivities')
                    ->where('volunteer_id',$request->input('volunteer_id'))
                    ->where('activity_id',$request->input('activity_id'))
                    ->update(['volunteerTimedIn' => true,'timeIn'=>\Carbon\Carbon::now()->format('Y-m-d H:i')]);

            $data = array("update"=>"timein");    

            return response()->json($data);

    }else{
            $data = array("update"=>"timeout");    

            return response()->json($data);
    }

   }

   public function successAttendance(Request $request){
    
              
                 $criteriaTotal = 0;
                 $sumOfPoints = 0;

                  //query
                 $activity = Activity::where('activity_id',$request->input('activity_id'))->first();
                 $volunteeractivity = Volunteeractivity::where('activity_id',$request->input('activity_id'))
                                                     ->where('volunteer_id',$request->input('volunteer_id'))->first();     

                                                     
                 $activity_skills = Activityskill::where('activity_id',$request->input('activity_id'))->get();
                 $volunteer = Volunteer::where('volunteer_id', $request->input('volunteer_id'))->first();
                 $volunteerBadges = Volunteerbadge::where('volunteer_id', $request->input('volunteer_id'))->get();

                 //$timeIn = \Carbon\Carbon::parse($volunteeractivity->timeIn)->format('h:i');

                 $timeOut =  \Carbon\Carbon::parse(\Carbon\Carbon::now()->format('Y-m-d H:i'));
                 $timeIn =  \Carbon\Carbon::parse($volunteeractivity->timeIn);
                 $ActivityEndtime = \Carbon\Carbon::parse($activity->endDate);

                 $timeInTimeOutDifference = null;

                 if($timeOut > $ActivityEndtime){
                        
                       $timeInTimeOutDifference = $timeIn->diffInHours($ActivityEndtime); 
                 }else{

                       $timeInTimeOutDifference = $timeIn->diffInHours($timeOut); 
                 }


                 $setting = \DB::table('settings')->first();
                 $totalPointsEarnedFromActivity = $activity->points_equivalent + ($timeInTimeOutDifference * $setting->activityHoursRenderedMultiplier);

                 \DB::table('volunteeractivities')
                    ->where('volunteer_id',$request->input('volunteer_id'))
                    ->where('activity_id',$request->input('activity_id'))
                    ->update(['status' => true,'points'=> $totalPointsEarnedFromActivity]);

                 
                //$activity_points = $criteriaTotal + $activity->points_equivalent;

                 // = "nothing", "new star", "new badge";
                 $newVolunteerBadge = null;        
                 $earnedAchievement = array();

                $total_points = $totalPointsEarnedFromActivity + $volunteer->points; //update volunteerpoints 
                  
                foreach ($activity_skills as $activity_skill) {
                      foreach ($volunteerBadges as $volunteerBadge) {
                           $newbie = false;
                           $body = null;
                           $update = "nothing";
                        if(strcmp($activity_skill->name, $volunteerBadge->skill) == 0){
                         
        
                              $newVolunteerBadgePoints = $volunteerBadge->points + $totalPointsEarnedFromActivity; //points daan sa skill Badge + points_equivalent
                              //$gauge_points = $skill_points_local * $this->badgePercentage($volunteerBadge); //gaugepoints = totalbadgeskillpoints apil karon * multiplier(0.2,0.3,0.4)
                              //echo $newVolunteerBadgePoints. ' WTF';

                                if(strcmp($volunteerBadge->badge, "Nothing") == 0){

                                     Volunteerbadge::where('volunteer_id', $volunteerBadge->volunteer_id)
                                                    ->where('badge', 'Nothing')
                                                    ->where('skill',$volunteerBadge->skill)  
                                                    ->update(['badge'=>'Newbie']);  

                                     $newVolunteerBadge = Volunteerbadge::select('volunteerbadges.*','badges.url as url','badges.*')
                                                                        ->join('badges',function($join){
                                                                          $join->on('badges.badge','=','volunteerbadges.badge')
                                                                              ->on('badges.skill','=','volunteerbadges.skill');
                                                                        })->where('volunteerbadges.volunteer_id','=',$volunteerBadge->volunteer_id)
                                                                          ->where('volunteerbadges.skill',$volunteerBadge->skill)->first();
                            

                                        $update = "new badge";
                                        $body = "NEW BADGE EARNED!";
                                        $newbie = true;

                                        $earned = array("update"=>$update,"body"=>$body,"BadgeInfo"=>$newVolunteerBadge,"points"=>$totalPointsEarnedFromActivity);
                                        array_push($earnedAchievement,$earned);
                                       // echo $newbie.' siya';
                                        //echo $newbie;

                                }

                                if($newVolunteerBadgePoints >= $this->getGauge($volunteerBadge->badge)){ 
                                      
                                    $newVolunteerBadgePoints = $newVolunteerBadgePoints - $this->getGauge($volunteerBadge->badge); //kuhaon ang subra para ibutang sa pts
                                     // echo $newVolunteerBadgePoints;  
                                      if($volunteerBadge->star == 5){//updateBadge kay 5 stars nah siya 
                                        
                                        $newVolunteerBadge = $this->updateBadge($volunteerBadge, $newVolunteerBadgePoints);
                                        $update = "new badge";
                                        $body = "NEW BADGE EARNED!";

                                        $earned = array("update"=>$update,"body"=>$body,"BadgeInfo"=>$newVolunteerBadge,"points"=>$totalPointsEarnedFromActivity);

                                          //echo '480 ';
                                        
                                        array_push($earnedAchievement,$earned);

                                      }
                                      else{

                                       // echo '487  ';

                                        $newVolunteerBadge = $this->updateStar($volunteerBadge, $newVolunteerBadgePoints);
                                        $update = "new star";
                                        $body = "NEW STAR EARNED!";
                                        
                                        $earned = array("update"=>$update,"body"=>$body,"BadgeInfo"=>$newVolunteerBadge,"points"=>$totalPointsEarnedFromActivity);

                                        array_push($earnedAchievement,$earned);

                                      }

                                }
                                else{
                                      //echo ' damn ni sud sa else'.$newVolunteerBadgePoints;
                                  //$skill_points_local = (int)($volunteerBadge->gauge_points + $gauge_points);
                                   Volunteerbadge::where('volunteer_id', $request->input('volunteer_id'))
                                      ->where('badge', $volunteerBadge->badge)
                                      ->where('skill',$activity_skill->name)
                                      ->update(['points'=>$newVolunteerBadgePoints]);

                            

                                       if($newbie == false){
                                        $update = "nothing";

                                        $earned = array("update"=>$update,"body"=>$body,"BadgeInfo"=>null,"points"=>$totalPointsEarnedFromActivity);
                                        array_push($earnedAchievement,$earned);
                                       } 
                                       
                                }
                           
                        }
                      }
                         
                }
                  

                Volunteer::where('volunteer_id',$request->input('volunteer_id'))->update(['points' => $total_points]);
                /*  
                \DB::table('activities')->where('activity_id',$request->input('activity_id'))->update(['points_equivalent' => $sumOfPoints]);*/

                $data = array("update"=>$update,"badgedata"=>$newVolunteerBadge,"text"=>$body);

                return response()->json($earnedAchievement);

                /*return response()->json($data);  */          
                /*"You have gained a new star"
                "You earned a new badge"*/

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
                 'status'=> false,
                 'timeIn'=>\Carbon\Carbon::now()->format('Y-m-d H:i')
                ]);
            

            $data = array("message"=>"Success");

            return response()->json($data);
            
            }
    }

    
    public function points($skill, $sumOfPoints){


                    switch($skill){

                         case 'Environmental': $sumOfPoints = $sumOfPoints + 10;
                                      break;          
                         case 'Sports': $sumOfPoints = $sumOfPoints + 8;                       
                                      break;
                         case 'Culinary': $sumOfPoints = $sumOfPoints + 8;
                                      break;
                         case 'Medical': $sumOfPoints = $sumOfPoints + 10;
                                      break;
                         case 'Charity': $sumOfPoints = $sumOfPoints + 10;
                                      break;
                         case 'Livelihood': $sumOfPoints = $sumOfPoints + 10;
                                      break;
                         case 'Education': $sumOfPoints = $sumOfPoints + 10;
                                      break;
                         case 'Arts': $sumOfPoints = $sumOfPoints + 8;
                                      break;
                         case 'Free for all': $sumOfPoints = $sumOfPoints + 15;
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

        $volunteerLeaders = \DB::table('volunteers')->select('users.name as name', 'volunteers.*','users.api_token as api_token')
                                                        ->join('users','users.user_id','=','volunteers.user_id')->orderBy('volunteers.points','desc')->get();


        return response()->json($volunteerLeaders);

    }  

    public function volunteeractivitycriteria(){
        
    }
  }