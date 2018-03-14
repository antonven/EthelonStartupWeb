<?php




namespace App\Http\Controllers;


use Illuminate\Console\Command;
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
use App\Notification;
use App\Notification_user;
use App\Volunteerbadge;
use App\Badge;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Groupnotification;

use Davibennun\LaravelPushNotification\Facades\PushNotification;

use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\App;

use Illuminate\Http\Request;

class TestingController extends Controller
{
    //

public function test2(){

$vol = Volunteer::all();

foreach($vol as $val){
  Volunteeractivity::create(['activity_id'=>'7d108d5','volunteer_id'=>$val->volunteer_id]);
}
}

public function group($volunteers, $activity, $skillName){

    //$volunteers = Volunteeractivity::where('activity_id',$activity->activity_id)->inRandomOrder()->get();
                
                $vol_per_group = 3; 
                $count = 0;
                $countforId = 1;
                $id = '';
                $volunteerCount = 0;
                $lastGroup = '';  
                $lastCount = 0; 

                $numOfVolunteers = count($volunteers);

                    foreach($volunteers as $volunteer){

                        $this->create_volunteer_criteria_points($activity, $volunteer->volunteer_id);

                      if($count < $vol_per_group){//maka sud pa siya og group
                            if($count == 0){//create new group reset
                                if($volunteerCount + 1 == $numOfVolunteers ){

                                    Volunteergroup::create([
                                         'activity_groups_id'=>$lastGroup,
                                         'volunteer_id' =>$volunteer->volunteer_id 
                                    ]);  

                                    \DB::table('activitygroups')->where('id',$lastGroup)->update(['numOfVolunteers' => $lastCount+1]);

                                }else{
                                   $id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);

                                    Activitygroup::create([
                                          'id'=> $id,
                                          'activity_id'=>$activity->activity_id ,
                                          'type'=>$skillName 
                                        ]);   

                                    Volunteergroup::create([
                                         'activity_groups_id'=>$id,
                                         'volunteer_id' =>$volunteer->volunteer_id 
                                    ]);    

                                    $count++;
                                    $countforId++;
                                    if($count == $vol_per_group || count($volunteers) == $vCount = $volunteerCount+1){
                                        \DB::table('activitygroups')->where('id',$id)->update(['numOfVolunteers' => $count]);
                                    }
                                }
                             

                            }else{

                                Volunteergroup::create([
                                     'activity_groups_id'=>$id,
                                     'volunteer_id' =>$volunteer->volunteer_id 
                                ]); 

                               
                                $count++;
                                if($count == $vol_per_group || count($volunteers) == $vCount = $volunteerCount+1){
                                    \DB::table('activitygroups')->where('id',$id)->update(['numOfVolunteers' => $count]);
                                }
                                 $lastGroup = $id;
                                 $lastCount = $count;
                            }
                      }
                      else{

                        $count = 0;
                           $id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);
                            if($volunteerCount + 1 == $numOfVolunteers){
                                  Volunteergroup::create([
                                         'activity_groups_id'=>$lastGroup,
                                         'volunteer_id' =>$volunteer->volunteer_id 
                                    ]);  

                                    \DB::table('activitygroups')->where('id',$lastGroup)->update(['numOfVolunteers' => $lastCount+1]);
                            }else{
                                    Activitygroup::create([
                                      'id'=> $id,
                                      'activity_id'=>$activity->activity_id,
                                      'type'=>$skillName  
                                    ]);   

                                    Volunteergroup::create([
                                         'activity_groups_id'=>$id,
                                         'volunteer_id' =>$volunteer->volunteer_id 
                                    ]);    

                                  $lastGroup = $id;
                                  $lastCount = $count;  
                                  $count++;
                                  $countforId++;
                                  
                                  if($count == $vol_per_group || count($volunteers) == $vCount = $volunteerCount+1){
                                      \DB::table('activitygroups')->where('id',$id)->update(['numOfVolunteers' => $count]);
                                  }
                            }        
                           

                      }     
                      $volunteerCount++;
                      }      
                      //Activity::where('activity_id',$activity->activity_id)->update(['status'=>true]);              
                    
}


  public function groupVolunteers($volunteers,$activity,$skillName,$first){
   
            
                $vol_per_group = 5; 
                //4 / 9
                $count = 0;
                $countforId = 1;
                $id = '';
                $volunteerCount = 0;   
                $activityArrays = array();
                $numOfVolunteers = count($volunteers);

                $lastGroup = null;
                $lastCount = 0;

                 // return count($volunteers);
                $tempC = 0;
                $agianan = array();

                $atay = array();
            
                    foreach($volunteers as $volunteer){

                          /*  if($volunteer->volunteer_id  == 'fd28a39'){
                                    dd($id);
                                  }*/

                      /*dd($skillName);*/
                        
                       $this->create_volunteer_criteria_points($activity, $volunteer->volunteer_id);

                        
                      if($count < $vol_per_group){//if wala pa naka abot sa num of volunteer per group
                            if($count == 0){//if nibalik nag reset sa num of group kay na sudlan nah

                                  if($volunteerCount == $numOfVolunteers-1){//if isa nalang siya adto siya i join sa last group
                                    $fuck = array("yawa"=>"NISULOD BRAD 1");
                   
                                    $lastCount = $lastCount + 1; 
                                   

                                     Volunteergroup::create([
                                             'activity_groups_id'=>$lastGroup,
                                             'volunteer_id' =>$volunteer->volunteer_id 
                                     ]);    

                                    \DB::table('activitygroups')->where('id',$lastGroup)->update(['numOfVolunteers' => $lastCount]);

                                  }else{//if dili pa siya isa sa list of volunteers

                                        $id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);


                                       if($volunteerCount + 2 != $numOfVolunteers-1){

                                            Activitygroup::create([
                                              'id'=> $id,
                                              'activity_id'=>$activity->activity_id,
                                              'type'=>$skillName  
                                            ]);

                                       } 


                                        Volunteergroup::create([
                                             'activity_groups_id'=>$id,
                                             'volunteer_id' =>$volunteer->volunteer_id 
                                        ]);    

                                        $count++;
                                        $countforId++;

                                        if($count == $vol_per_group || count($volunteers) == $vCount = $volunteerCount+1){
                                            \DB::table('activitygroups')->where('id',$id)->update(['numOfVolunteers' => $count]);
                                        }

                                    }


                            }else{

                                Volunteergroup::create([
                                     'activity_groups_id'=>$id,
                                     'volunteer_id' =>$volunteer->volunteer_id 
                                ]); 

                                $count++;

                                if($count == $vol_per_group || count($volunteers) == $vCount = $volunteerCount+1){
                                    \DB::table('activitygroups')->where('id',$id)->update(['numOfVolunteers' => $count]);
                                }
                                $lastCount = $count;
                                $lastGroup = $id;

                                }
                            }
                      else{//na allocatan nah og volunteer ang group so himo balik og group

                        $count = 0;
                           $id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);
                                    //ngari 2
                             if($volunteerCount + 2 != $numOfVolunteers-1 && $volunteerCount != $numOfVolunteers-1){//if dili pa last ang  sunod volunteer og dili siya ang last nga volunteer

                                            Activitygroup::create([
                                              'id'=> $id,
                                              'activity_id'=>$activity->activity_id,
                                              'type'=>$skillName  
                                            ]);

                                            Volunteergroup::create([
                                             'activity_groups_id'=>$id,
                                             'volunteer_id' =>$volunteer->volunteer_id 
                                            ]);  

                                            $count++;
                                            \DB::table('activitygroups')->where('id',$id)->update(['numOfVolunteers' => $count]);

                                            $lastGroup = $id;
                                            $lastCount = $count;

                              }else if($volunteerCount == $numOfVolunteers-1){//if last nga volunteer

                                  $fuck = array("yawa"=>"NISULOD BRAD 2","id sa last = "=>$lastGroup,"count"=>$lastCount);
                                
                                  $lastCount = $lastCount + 1;

                                     Volunteergroup::create([
                                             'activity_groups_id'=>$lastGroup,
                                             'volunteer_id' =>$volunteer->volunteer_id 
                                     ]);    

                                    \DB::table('activitygroups')->where('id',$lastGroup)->update(['numOfVolunteers' => $lastCount]);

                                  }/*else{
                                       Activitygroup::create([
                                              'id'=> $id,
                                              'activity_id'=>$activity->activity_id,
                                              'type'=>$skillName  
                                            ]);

                                            Volunteergroup::create([
                                             'activity_groups_id'=>$id,
                                             'volunteer_id' =>$volunteer->volunteer_id 
                                            ]);
                                  }  */

                                if($count == $vol_per_group || count($volunteers) == $vCount = $volunteerCount+1){
                                    \DB::table('activitygroups')->where('id',$id)->update(['numOfVolunteers' => $count]);
                                }

                      }     
                      $volunteerCount++;
                     // $tempC++;
                      }
                       if($skillName == 'Education'){
                      // dd($agianan);
                          }

           // $activitygroups = Activitygroup::where('activity_id','c3b8c9f')->get();
            //dd($activityArrays);

            //return response()->json($activitygroups);


                      return $activityArrays;
                     
  }  


   public function sort($activity,$volunteers){



      $allVolunteers = $volunteers;
      $noMatches = array();
      $yesMatches = array();
      $skills = Activityskill::where('activity_id',$activity->activity_id)->get();
    
      foreach($allVolunteers as $allVolunteer){

        $volunteerSkills = Volunteerskill::where('volunteer_id',$allVolunteer->volunteer_id)->get();
        $matches = false;
        $skwa = null;


       // dd($volunteerSkills);

          foreach($skills as $skill){

             foreach($volunteerSkills as $volunteerSkill){
                $skwa = $allVolunteer;
               if(strcasecmp($skill->name , $volunteerSkill->name)==0){
                                    
                  $tonight = $skill->name . $volunteerSkill->name;
                  //dd($tonight);
                                    $matches = true;
                                    
                                    break;
                                        
                  }
             }

          }

        //  dd($matches);

        if($matches == false ){
           array_push($noMatches,$allVolunteer);
        }else{
           array_push($yesMatches,$allVolunteer);
        }

      }


     // return count($noMatches). ' '.count($yesMatches);


      $atay = array();

      //if isa  
      if(count($noMatches) == 1){
        foreach($noMatches as $noMatch){
            array_push($yesMatches,$noMatch);
        }

        $noMatches = array();

      }
      
      //if isa  
      if(count($yesMatches) == 1){
        foreach($yesMatches as $yesMatch){
            array_push($noMatches,$yesMatch);
        }

        $yesMatches = array();
      }


      $rets1 = $this->group($noMatches,$activity,'none');
      array_push($atay, $rets1);
      $rets2 = $this->groupMatches($yesMatches,$activity);
      array_push($atay, $rets2);

      return $atay;

      //return $noMatches;
    }



    public function groupMatches($volunteers, $activity){


      $skills = Activityskill::where('activity_id',$activity->activity_id)->get();
      $numOfSkills = $skills->count();

      $skillsObjectsLists = array();
      $ilhanan = false;

      foreach($skills as $skill){

        $array = array();
        $skillObject = (object) array("name"=>$skill->name,"volunteers"=>$array,"count"=>0);
       
        json_encode($skillObject);
        array_push($skillsObjectsLists,$skillObject);

      }

      foreach($volunteers as $volunteer){
       
          $skills = Volunteerskill::where('volunteer_id',$volunteer->volunteer_id)->get();
          
               usort($skillsObjectsLists, function($a, $b){
                
                return strcmp($a->count, $b->count);    
               });

              foreach($skillsObjectsLists as $skillsObjectsList){

                foreach($skills as $skill){
                     
                    if(strcasecmp($skill->name , $skillsObjectsList->name)==0){

                      if($ilhanan == false){
                          array_push($skillsObjectsList->volunteers,$volunteer);
                          $skillsObjectsList->count = $skillsObjectsList->count + 1;
                          $ilhanan = true;
                          break;
                      }  
                      
                    }
                }
                  
              }
              $ilhanan = false;

      }

      $pangTest = array();

      
      $count_para_sa_bug = true;

      foreach($skillsObjectsLists as $skillsObjectsList){
        
        $test = $this->group($skillsObjectsList->volunteers,$activity,$skillsObjectsList->name,$count_para_sa_bug);
        array_push($pangTest,count($skillsObjectsList->volunteers));
        $count_para_sa_bug = false;

      }

      //dd($pangTest);
     
      return $pangTest;
      
    }


    public function skill(){

      $activity = Activity::where('activity_id','fc63a6a')->first();
      $volunteers = \DB::table('volunteers')->limit(2)->get()->toArray();
      $vol = Volunteer::where('volunteer_id','f505ca')->first();

     

      array_push($volunteers,$vol);

      //$volunteers = (object)$volunteers;

     

    //  $volunteers = Volunteer::where('volunteer_id','00b35ab')->get();

      $asq = $this->sort($activity,$volunteers);
     // $asq = $this->groupVolunteers($volunteers_with_no_match,$activity);

      return $asq;

    }

    public function deleteall(){
     
    //  \DB::table('users')->delete();
    // \DB::table('foundations')->delete();
    // \DB::table('volunteers')->delete();
    // \DB::table('activityskills')->delete();
     \DB::table('volunteergroups')->delete();
    // \DB::table('volunteeractivities')->delete();f

    // \DB::table('groupnotifications')->delete();
    // \DB::table('volunteerbeforeactivities')->delete();
    // \DB::table('volunteerafteractivities')->delete();
    // \DB::table('activitycriterias')->delete();
    // \DB::table('volunteercriteriapoints');
    // \DB::table('volunteerskills')->delete();
    // \DB::table('volunteeractivities')->delete();
     \DB::table('activitygroups')->delete();
    // \DB::table('volunteercriterias')->delete();
    // \DB::table('groupnotifications')->delete();
    // \DB::table('activities')->delete();

    /*Volunteer::where('volunteer_id','08ab5fe')->delete();
    User::where('user_id','1877377522288783')->delete();
    Volunteerskill::where('volunteer_id','08ab5fe')->delete()*/;

    }

    public function kobedelete(){

     /* Activitygroup::where('activity_id','a77c9b4')->delete();
      Volunteercriteriapoint::where('activity_id','a77c9b4')->delete();*/
      /*Volunteeractivity::where('activity_id','f9fd3cc')
                         ->where('volunteer_id','a0e716a')->delete(); 
      Volunteeractivity::where('volunteer_id','a0e716a')
                          ->where();  

                          \DB:      */           


                            //return response()->json(Volunteer::all());
                          /*\DB::table('activities')->delete();
                          \DB::table('activityskills')->delete();*/
                          \DB::table('activitygroups')->delete();
                         // \DB::table('volunteeractivities')->delete();
                          \DB::table('volunteergroups')->delete();
                          \DB::table('volunteercriteriapoints')->delete();

                      

    }

    public function sendNotifForFiveHours($fcm_token,$criteriaTotal,$activityName){

      echo  'total = '.$criteriaTotal;
      dd($fcm_token);

                            $optionBuilder = new OptionsBuilder();
                            $optionBuilder->setTimeToLive(60*20);
                            $optionBuilder->setPriority('high');

                            $body = 'You have earned additional '.$criteriaTotal.'points for the ' .$activityName. 'activity';
                          $notificationBuilder = new PayloadNotificationBuilder($activityName);
                          $notificationBuilder->setBody($body)
                                              ->setSound('default'); 

                             $dataBuilder = new PayloadDataBuilder();
                         /*    $dataBuilder->addData([
                                
                                'eventImage'=>$activity->image_url,
                                'eventHost' =>$activity->foundation_name,
                                'eventName'=>$activity->name,
                                'activity_id'=>$activity->activity_id,
                                'eventDate'=>$activity->startDate, 
                                'eventTimeStart'=>$activity->start_time,
                                'eventLocation'=>$activity->location, 
                                'contactNo'=>$activity->contact, 
                                'contactPerson'=>$activity->contactperson,  
                                
                                ]);*/

                            $option = $optionBuilder->build();
                            $notification = $notificationBuilder->build();
                            $data = $dataBuilder->build();

                         /*   Notification::create([
                                    'id'=>$notification_id,
                                    'title'=>$activity->name,
                                    'body' => $body,
                                    'major_type'=>'activity_group',
                                    'sub_type'=>'activity_group',
                                    'data'=>$activity->activity_id
                                ]);*/

                            $downstreamResponse = FCM::sendTo($fcm_token, $option, $notification, $data); 

                            dd($downstreamResponse);                     

    }



    public function test3(){

      $activities_with_false_5hrs = \DB::table('activities')->select('activities.*')->where('fiveHours',true)->get();
                                        
     
      foreach($activities_with_false_5hrs as $activity_with_false_5hrs){

        // echo ' fuck naa'. '  '. \Carbon\Carbon::parse($activity_with_false_5hrs->endDate) . '  now = ' . \Carbon\Carbon::now();

          if(\Carbon\Carbon::parse($activity_with_false_5hrs->endDate)->addHours(5) <=  \Carbon\Carbon::now()){
              //echo ' fuck naa'. '  '. \Carbon\Carbon::parse($activity_with_false_5hrs->endDate) . '  now = ' . \Carbon\Carbon::now();

             $volunteers = \DB::table('volunteers')->select('volunteers.*')
                                                ->join('volunteeractivities','volunteeractivities.volunteer_id','=','volunteers.volunteer_id')
                                                ->where('volunteeractivities.activity_id',$activity_with_false_5hrs->activity_id)
                                                ->where('volunteeractivities.status',false)
                                                ->where('volunteers.volunteer_id','2deaf28')
                                                ->get(); 

                                          

              $activityskills = Activityskill::where('activity_id',$activity_with_false_5hrs->activity_id)->get();                                  
                   
                    foreach($volunteers as $volunteer){

                       $volunteercriteriapoints = Volunteercriteriapoint::where('volunteer_id',$volunteer->volunteer_id)
                                                                          ->where('activity_id',$activity_with_false_5hrs->activity_id)
                                                                          ->get();

                                        $criteriaTotal = 0;

                       foreach($volunteercriteriapoints as $Volunteercriteriapoint){

                            $criteriaTotal = $Volunteercriteriapoint->average_points + $criteriaTotal;

                       }
                      
                        foreach($activityskills as $activityskill){

                                $volunteerbadge = Volunteerbadge::where('volunteer_id',$volunteer->volunteer_id)
                                                                ->where('skill',$activityskill->name)
                                                                ->first();
                                                                 
                                $newBadgePoints = $volunteerbadge->points + $criteriaTotal;

                                $volunteerbadge = Volunteerbadge::where('volunteer_id',$volunteer->volunteer_id)
                                                                ->where('skill',$activityskill->name)
                                                                ->update(['points'=>$newBadgePoints]);

                                $totalVolPoints = $volunteer->points + $criteriaTotal;                                  
                                Volunteer::where('volunteer_id',$volunteer->volunteer_id)->update(['points'=>$totalVolPoints]);                                 
                        }     

                        $this->sendNotifForFiveHours($volunteer->fcm_token,$criteriaTotal,$activity_with_false_5hrs->name);                                                   
                    }                             

          }

          $activity_with_false_5hrs->fiveHours = false;
          $activities_with_false_5hrs = \DB::table('activities')->select('activities.*')->update(['fiveHours'=>false]);

      }


    /*  Volunteercriteriapoint::create(['id'=>'asds','volunteer_id'=>'2deaf28','activity_id'=>'c3b8c9f','criteria_name'=>'gwapo','total_points'=>10,'no_of_raters'=>2,'average_points'=>5]);
      Volunteercriteriapoint::create(['id'=>'asds','volunteer_id'=>'2deaf28','activity_id'=>'c3b8c9f','criteria_name'=>'kobe','total_points'=>10,'no_of_raters'=>2,'average_points'=>5]);*/
      
     /*$volunteers = Volunteer::all();
     $array = array();*/

    /* Volunteerbadge::where('volunteer_id','2deaf28')->where('skill','Environmental')->update(['gaugeExp'=>0,'star'=>3,'points'=>0,'badge'=>'Legend']);
     
     Volunteerbadge::where('volunteer_id','2deaf28')->where('skill','Sports')->update(['gaugeExp'=>0,'star'=>0,'points'=>4,'badge'=>'Legend']);
     Volunteerbadge::where('volunteer_id','2deaf28')->where('skill','Culinary')->update(['gaugeExp'=>0,'star'=>0,'points'=>3,'badge'=>'Legend']);
     Volunteerbadge::where('volunteer_id','2deaf28')->where('skill','Medical')->update(['gaugeExp'=>0,'star'=>0,'points'=>2,'badge'=>'Legend']);
     Volunteerbadge::where('volunteer_id','2deaf28')->where('skill','Charity')->update(['gaugeExp'=>0,'star'=>0,'points'=>1,'badge'=>'Legend']);
     Volunteerbadge::where('volunteer_id','2deaf28')->where('skill','Livelihood')->update(['gaugeExp'=>0,'star'=>4,'points'=>0,'badge'=>'Legend']);
     Volunteerbadge::where('volunteer_id','2deaf28')->where('skill','Education')->update(['gaugeExp'=>0,'star'=>4,'points'=>0,'badge'=>'Legend']);
     Volunteerbadge::where('volunteer_id','2deaf28')->where('skill','Arts')->update(['gaugeExp'=>0,'star'=>0,'points'=>5,'badge'=>'Legend']);*/




     /*$array = array();

     \DB::table('Volunteerbadges')->where('volunteer_id','2deaf28')->delete();

     $skills = array('Environment','Education','Sports','Arts','Medical','Culinary','Livelihood','Charity');


     foreach($skills as $skill){

            $sd = Volunteerbadge::create([
                  'badge'=>'Nothing',
                  'volunteer_id'=>'2deaf28',
                  'gaugeExp'=>0,
                  'star'=>0,
                  'skill'=>$skill,
                  'points'=>0
          ]);

          array_push($array,$sd);
           
     }

      return response()->json($array);*/

   /*  json_encode($skill);
     dd($skill);
     array_push($array,$skill);
     $skill = array('skill'=>'Education');
     json_encode($skill);
     array_push($array,$skill);
     $skill = array('skill'=>'Sports');
     json_encode($skill);
     array_push($array,$skill);
     $skill = array('skill'=>'Medical');
     json_encode($skill);
     array_push($array,$skill);
     $skill = array('skill'=>'Culinary');
     json_encode($skill);
     array_push($array,$skill);
     $skill = array('skill'=>'Livelihood');
     json_encode($skill);
     array_push($array,$skill);
     $skill = array('skill'=>'Charity');
     json_encode($skill);
     array_push($array,$skill);
     $skill = array('skill'=>'Arts');
     json_encode($skill);
     array_push($array,$skill);*/

    
     /* $skills = Volunteerskill::where('volunteer_id','b5feb04')->get();
      return response()->json($skills);*/

/*
      foreach($volunteers as $volunteer){
        foreach($skills as $skill){
          

           Volunteerbadge::create([
                  'badge'=>'Nothing',
                  'volunteer_id'=>$volunteer->volunteer_id,
                  'gaugeExp'=>0,
                  'star'=>0,
                  'skill'=>$skill,
                  'points'=>0
          ]);

        }

      }
*/

/*
  Volunteeractivity::create([
                 'volunteer_id'=>'b2b66de',
                 'activity_id'=>'7ca34a3',
                 'status'=> false  
                ]);
*/

      
      


     /* foreach($volunteers as $volunteer){
        Volunteeractivity::create([
                 'volunteer_id'=>$volunteer->volunteer_id,
                 'activity_id'=>'3b35ef4',
                 'status'=> false  
                ]);
      }*/



       
/*
        $volunteerTokens = Volunteer::pluck('fcm_token')->toArray();

                            $optionBuilder = new OptionsBuilder();
                            $optionBuilder->setTimeToLive(60*20);
                            $optionBuilder->setPriority('high');

                            $kobe = 'kobe';

                             $body = 'Your groupmates have been revealed for '.$kobe.' activity';
 
                          $notificationBuilder = new PayloadNotificationBuilder('Ethelon');
                          $notificationBuilder->setBody('ANDROID STUDIO BOGO')
                                              ->setSound('default'); 

                            $dataBuilder = new PayloadDataBuilder();
                             $dataBuilder->addData([
                               'FuckShit'    => "Fuck?" 
                                ]);


                            $option = $optionBuilder->build();
                            $notification = $notificationBuilder->build();
                           // $data = $dataBuilder->build();

                            $downstreamResponse = FCM::sendTo('cncXed496kY:APA91bFX3s-aGJ1jmW8E3zhvXJkjUX18i1yS-XXxcEqyi4RezYJwofiNFoZLRgdh3T_NW3QVS6d8YHxwmpMKxg3VlcTRc4cG106TWCz_TGlaYFKqDyA_N4CJ5OTRSMfhco5tBVBQdb7H', $option, $notification, null);

                            dd($downstreamResponse);*/


    /*   Volunteeractivity::where('activity_id','a77c9b4')->delete();*/
     /* Activitygroup::where('activity_id','a77c9b4')->delete();
      Volunteercriteriapoint::where('activity_id','a77c9b4')->delete();*/

    }

   /*  protected function runScheduler()
    {
        $fn = $this->option('queue') ? 'queue' : 'call';

        
        $activities = \DB::table('activities')->select('activities.*','foundations.name as foundation_name')
                                ->join('foundations','foundations.foundation_id','=','activities.foundation_id')
                                ->where('activities.status',false)
                                ->whereDate('activities.startDate',\Carbon\Carbon::tomorrow()->format('y-m-d'))->get();

                            if($activities->count()){
                                
                                $this->randomAllocation($activities);

                            }    



                  }                                   


        $this->info('Running scheduler');
        Artisan::$fn('schedule:run');
        $this->info('completed, sleeping..');
        sleep($this->nextMinute());
        $this->runScheduler();
    }*/

    public function runScheduler(){

  
                            $activities = \DB::table('activities')->select('activities.*','foundations.name as foundation_name','foundations.foundation_id as foundation_id')
                                ->join('foundations','foundations.foundation_id','=','activities.foundation_id')
                                ->where('activities.status',false)
                                ->get();

                                

                              /*  if($activities->count()){
                                    $this->info('nay sulod '.\Carbon\Carbon::now()->format('y-m-d h:i'));
                                }else{
                                    $this->info('walay sulod '.\Carbon\Carbon::now()->format('y-m-d h:i'));
                                }*/

            foreach($activities as $activity){

                           // $this->info('nay sulod '.$activity->registration_deadline);

                            return $this->randomAllocation($activity);
                             
/*
                 $date = substr($activity->startDate, 0,strpos($activity->startDate, ' ')); 
                 $datesaved = $date. ' '.$activity->start_time;
                 $date5minutes = \Carbon\Carbon::parse($datesaved)->addMinute(5)->format('y-m-d h:i');*/
/*
                     if($date5minutes == \Carbon\Carbon::now()->format('y-m-d h:i') || $date5minutes < \Carbon\Carbon::now()->format('y-m-d h:i')){

                        $this->info('sud sa if '.$date5minutes.' =now='.\Carbon\Carbon::now()->format('y-m-d h:i'));
                        $this->randomAllocation($activity);
 
                     }else{

                               $this->info('sud sa else'.$date5minutes. ' =now='.\Carbon\Carbon::now()->format('y-m-d h:i'));
                       }*/
/*
                       $activity_deadlineTime = \Carbon\Carbon::parse($activity->registration_deadline)->format('h:i');
                       $timeNow = \Carbon\Carbon::now()->format('h:i');
                       $formattedTime =  \Carbon\Carbon::parse($timeNow)->tz('UTC');
                       $activity_deadline = \Carbon\Carbon::parse($activity->registration_deadline)->format('y-m-d');

                if($activity_deadline <= \Carbon\Carbon::now()->format('y-m-d')){
                        $this->info('sud sa date if');

                       if($activity_deadlineTime <= $timeNow){
                            $this->info('==sulod pa '.$activity->name.' = '.$timeNow.' !! '.$activity_deadlineTime); 
                            $this->randomAllocation($activity);
                       }else{
                            $this->info('==wala pa');
                       }

                }else{


                }   */
                                              
            }

    }

  
  public function randomAllocation($activity){

                $volunteers = Volunteeractivity::where('activity_id',$activity->activity_id)->inRandomOrder()->get();

       
                
                $vol_per_group = $activity->group; 
                $count = 0;
                $countforId = 1;
                $id = '';
                $volunteerCount = 0;   

                    foreach($volunteers as $volunteer){

                        $this->create_volunteer_criteria_points($activity, $volunteer->volunteer_id);

                      if($count < $vol_per_group){
                            if($count == 0){

                                $id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);

                                Activitygroup::create([
                                      'id'=> $id,
                                      'activity_id'=>$activity->activity_id  
                                    ]);   

                                Volunteergroup::create([
                                     'activity_groups_id'=>$id,
                                     'volunteer_id' =>$volunteer->volunteer_id 
                                ]);    

                                $count++;
                                $countforId++;
                                if($count == $vol_per_group || count($volunteers) == $vCount = $volunteerCount+1){
                                    \DB::table('activitygroups')->where('id',$id)->update(['numOfVolunteers' => $count]);
                                }

                            }else{

                                Volunteergroup::create([
                                     'activity_groups_id'=>$id,
                                     'volunteer_id' =>$volunteer->volunteer_id 
                                ]); 

                                $count++;
                                if($count == $vol_per_group || count($volunteers) == $vCount = $volunteerCount+1){
                                    \DB::table('activitygroups')->where('id',$id)->update(['numOfVolunteers' => $count]);
                                }
                            }
                      }
                      else{

                        $count = 0;
                           $id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);
                                    
                                Activitygroup::create([
                                      'id'=> $id,
                                      'activity_id'=>$activity->activity_id  
                                    ]);   

                                Volunteergroup::create([
                                     'activity_groups_id'=>$id,
                                     'volunteer_id' =>$volunteer->volunteer_id 
                                ]);    

                                $count++;
                                $countforId++;
                                
                                if($count == $vol_per_group || count($volunteers) == $vCount = $volunteerCount+1){
                                    \DB::table('activitygroups')->where('id',$id)->update(['numOfVolunteers' => $count]);
                                }

                      }     
                      $volunteerCount++;
                      }      
                      Activity::where('activity_id',$activity->activity_id)->update(['status'=>true]);              
                      return $this->sendNotifications($activity);
    }

 public function sendNotifications($activity){

        $tokens = array();

       // foreach($activities as $activity){

          $volunteers = \DB::table('volunteeractivities')->select('volunteers.*')
                                                               ->join('volunteers','volunteers.volunteer_id','=','volunteeractivities.volunteer_id')
                                                               ->where('volunteeractivities.activity_id',$activity->activity_id)->inRandomOrder()->get(); 

          $volunteersKeeper = array();

          $notification_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);

        //  return response()->json($volunteers);

            foreach($volunteers as $volunteer){

                       $token = $volunteer->fcm_token;

                            if($token != null){
                                $notification_user_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);

                               $notification =  Notification_user::create([
                                       'id'=>$notification_user_id,
                                       'notification_id' => $notification_id,
                                       'sender_id'=> $activity->activity_id,
                                       'receiver_id'=>$volunteer->volunteer_id,
                                       'date'=> \Carbon\Carbon::now()->format('Y-m-d h:i')
                                    ]);
                              
                                array_push($tokens,$token);

                             }else{

                                Groupnotification::create([
                                    'volunteer_id'=>$volunteer->volunteer_id,
                                    'activity_id'=>$activity->activity_id,
                                    'date'=>\Carbon\Carbon::now()->format('Y-m-d h:i')
                                    ]);

                            }
                           
             }




                            $optionBuilder = new OptionsBuilder();
                            $optionBuilder->setTimeToLive(60*20);
                            $optionBuilder->setPriority('high');

                            $body = 'Your groupmates have been revealed for '.$activity->name.' activity';
 
                          $notificationBuilder = new PayloadNotificationBuilder($activity->name);
                          $notificationBuilder->setBody($body)
                                              ->setSound('default'); 

                             $dataBuilder = new PayloadDataBuilder();
                             $dataBuilder->addData([
                                
                                'eventImage'=>$activity->image_url,
                                'eventHost' =>$activity->foundation_name,
                                'eventName'=>$activity->name,
                                'activity_id'=>$activity->activity_id,
                                'eventDate'=>$activity->startDate, 
                                'eventTimeStart'=>$activity->start_time,
                                'eventLocation'=>$activity->location, 
                                'contactNo'=>$activity->contact, 
                                'contactPerson'=>$activity->contactperson,  
                                
                                ]);

                            $option = $optionBuilder->build();
                            $notification = $notificationBuilder->build();
                            $data = $dataBuilder->build();

                            Notification::create([
                                    'id'=>$notification_id,
                                    'title'=>$activity->name,
                                    'body' => $body,
                                    'major_type'=>'activity_group',
                                    'sub_type'=>'activity_group',
                                    'data'=>$activity->activity_id
                                ]);

                            $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
                             
      
            
           // return $downstreamResponse;
       // }

    }

  


  public function create_volunteer_criteria_points($activity, $volunteer_id){

     $criterias = Activitycriteria::where('activity_id',$activity->activity_id)->get();

      foreach($criterias as $criteria){

            Volunteercriteriapoint::create([
                
                'activity_id'=>$activity->activity_id,
                'volunteer_id'=>$volunteer_id,
                'criteria_name'=>$criteria->criteria,
                'total_points'=>0,
                'no_of_raters'=>0,
                'average_points'=>0
                 
                ]);
      }
    //}



}
}


