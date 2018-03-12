<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Groupnotification;


class SchedulerColler extends Controller
{
     public function handle()
    {


       
        
     /*              
        $activities = \DB::table('activities')->select('activities.*','foundations.name as foundation_name')
                                ->join('foundations','foundations.foundation_id','=','activities.foundation_id')
                                ->where('activities.status',false)
                                ->whereDate('activities.startDate',\Carbon\Carbon::now()->addMinute(5))->get();
                
                                                       
      if($activities->count()){
        
        $this->randomAllocation($activities);  
        
       }                          */   
        

        /*$this->info('Waiting '. $this->nextMinute(). ' for next run of scheduler');
        sleep($this->nextMinute());
        $this->runScheduler();*/
    }

    /**
     * Main recurring loop function.
     * Runs the scheduler every minute.
     * If the --queue flag is provided it will run the scheduler as a queue job.
     * Prevents overruns of cron jobs but does mean you need to have capacity to run the scheduler
     * in your queue within 60 seconds.
     *
     */
    //b2b66de

    public function thesis($activity){
                         
                    /*     $this->info('392');
                         
                         $this->info('394');
                         $this->info(' 395 '.$activity->name);*/

                         $actskills = $activity->skills;

                         //$volunteer = Volunteer::first();

                         $activityId = $activity->activity_id; 

                        $volunteersNoMatch = Volunteer::whereDoesntHave('volunteerSkills',function($query) use ($actskills){
                                                     $query->whereIn('name',$actskills);
                                             })->whereHas('activitiesJoined',function($query2)use ($activity){
                                                     $query2->whereIn('activity_id',$activity);
                                             })->get();
                                           

                        $volunteersMatch = Volunteer::whereHas('volunteerSkills',function($query) use ($actskills){
                                                     $query->whereIn('name',$actskills);
                                             })->whereHas('activitiesJoined',function($query2)use ($activity){
                                                     $query2->whereIn('activity_id',$activity);
                                             })->get(); 



                                            // dd($volunteersNoMatch);
                                             //dd($skills);  

                            $grpN = $activity->group / 2;

                            $grpM = $grpN + ($activity->group % 2);

                          // echo (int)$grpN . (int)$grpM;

                            echo $volunteersNoMatch->count();

                            $nM = null;
                            $m = null;

                           if($volunteersNoMatch->count()!=0) 
                           $nM = $this->thesis1($activity,$volunteersNoMatch,$grpN);  

                           if($volunteersMatch->count()!=0)  
                           $m = $this->thesis1($activity,$volunteersMatch,$grpM);  



                           
                            $objects = array_merge($nM,$m);

                            dd($objects);

                            Activity::where('activity_id',$activity->activity_id)->update(['status'=>true]);
                            $this->sendNotifications($activity);

                           
    }


       public function thesis1($activity,$volunteers,$group){
/*
      $volunteers = \DB::table('volunteeractivities')->select('volunteeractivities.volunteer_id')
                        ->join('activityskills','activityskills.activity_id','=','volunteeractivities.activity_id')
                        ->join('volunteerskills','volunteerskills.volunteer_id','=','volunteeractivities.volunteer_id')
                        ->('volunteerskills.name')
                        ->where('volunteeractivities.activity_id','df7505a')
                        ->get();
*/

                      /*  $volunteersWithMatched = \DB::table('volunteerskills')->select('volunteers.*','volunteerskills.name')
                                      ->join('volunteers','volunteers.volunteer_id','=','volunteerskills.volunteer_id')
                                      ->whereIn('volunteerskills.name',function($query){
                                             $query->select('name')->from('activityskills')->where('activity_id','df7505a');
                                        })->get();*/


                        

                        /*$volunteersNotMatched = \DB::table('volunteerskills')
                                      ->select('volunteers.*','volunteerskills.name')
                                      ->join('volunteers','volunteers.volunteer_id','=','volunteerskills.volunteer_id')
                                      ->whereNotIn('volunteerskills.name',function($query){
                                             $query->select('name')->from('activityskills')->where('activity_id','df7505a');
                                        })->get();  

                               $volunteers = Volunteer::all();*/
 
                       //$activityskills = Activityskill::where('volunteer_id','df7505a')->get(); 

                                      

                        //dd($volunteerz);


                        //return response()->json($volunteer);

                         /*$volunteers = Volunteeractivity::select('volunteers.*')->join('volunteers','volunteers.volunteer_id','=','volunteeractivities.volunteer_id')
                                                        ->where('volunteeractivities.activity_id','df7505a')
                                                        ->whereHas('volunteeractivities.name',function($query){
                            $query->whereIn('name',['activityskills']);
                         })->get();*/

                         // /dd($volunteers);
                         //dd($activity);

                      //$volunteers = Volunteeractivity::select('volunteers.*')->join('volunteers','volunteers.volunteer_id','=','volunteeractivities.volunteer_id')->where('volunteeractivities.activity_id','df7505a')->get();   

//                          $volunteers = Volunteer::select('volunteers.*')->limit(10)->get();


                       //dd($volunteers);

                     //  $volunteers = Volunteer::all();           
                         $setting = \DB::table('settings')->first();

                        $volObj = array();

                        foreach($volunteers as $volunteer){

                          $ageWeight = $setting->agePercentage -($volunteer->age/$setting->ageTotal)*$setting->agePercentage;
                          $pointWeight = $setting->pointPercentage -($volunteer->points/$setting->pointTotal)*$setting->pointPercentage;
                          $total = $ageWeight + $pointWeight;

                          $vol = (object)array("volunteer"=>$volunteer,"total"=>$total,"previous"=>null,"index"=>null);

                          array_push($volObj,$vol);
                          
                        }


                        $move = true;
                        $first = true;
                        $objects = array();

                      
                            for($i = 0; $i < $group; $i++){

                              $min = 1;

                              if($volunteers->count() < $group){
                                $min = $volObj[0]->total;  
                              }else{
                                 $min = $volObj[$i]->total;
                              }
                             
                              $max = 100;
                              $array = array();
                             // echo 'nisud for';
                              $dat = rand($min,$max);

                              $object = (object)array("centroid"=>$min,"array"=>$array,"id"=>$i);
                              array_push($objects,$object);

                              $first = false;
                            } 
                         //   dd($objects);
                            

                            
                     $test = 0;
                          do{
                            

                             $move = false;
                             

                            foreach($volObj as $volObj1){
                              $last = 99999999999999999999999999999999; 
                              $centroid = null;

                             
                             
                             // echo '125'.$move;
                              foreach($objects as $object){

                                $difference = null;
                                
                                if($object->centroid > $volObj1->volunteer->points ){
                                    $ans =  $volObj1->total - $object->centroid;
                                    $difference =  abs($ans);
                                    
                                }else{
                                    $ans =  $volObj1->total - $object->centroid;
                                    $difference =  abs($ans);
                                }
                                

                                if($last > $difference){

                                  $last = $difference;
                                  $centroid = $object->centroid;
                                 
                                 
                                } 


                              }

                            //  echo ' last ='.$last. ' centroid = '.$centroid;

                               
                              foreach($objects as $object){

                               // echo $object->centroid .' = '. $centroid;
                                $forIndex = 0;
                                
                                if($object->centroid == $centroid){
                                  $match = false;

                                  foreach($object->array as $array){

                                    if($array->volunteer->volunteer_id == $volObj1->volunteer->volunteer_id){
                                    //  echo 'nana';
                                      $match = true;//nana siya daan
                                      break;
                                      
                                    }
                                  }
                                   
                                  if($match == false){
                                    if($volObj1->previous==null && $volObj1->index == null){
                                      
                                     $volObj1->index = $forIndex;
                                     $volObj1->previous = $object->id;

                                      //dd($volObj1-);
                                     // echo ' index if = '. $volObj1->index;
                                      array_push($object->array,$volObj1);
                                      

                                    }else{
                                      
                                      foreach($objects as $arrayObj){
                                          if($volObj1->previous == $arrayObj->id){
                                           // echo $arrayObj->array[$volObj1->index]->volunteer->volunteer_id. '  ';
                                           // unset($arrayObj->array[$volObj1->index]);
                                            array_splice($arrayObj->array,$volObj1->index,1);
                                            //echo $arrayObj->array[$volObj1->index]->volunteer->volunteer_id. '  ';
                                            //return response()->json($arrayObj->array);
                                          }
                                      }
                                      $volObj1->previous = $object->id;
                                      $volObj1->index = $forIndex;
                                     // echo ' index = '.$forIndex;
                                      array_push($object->array,$volObj1);
                                  }
                                    
                                    $move = true;
                                   // echo '180'.$move;
                                 }

                                }

                                $forIndex++;
                                
                              }
                             // echo $centroid;
                             // return response()->json($volObj1);
                              
                              $last = 9999999999999999999999999999; 

                            }

                            foreach($objects as $object){
                            
                              $total = 0;

                              foreach($object->array as $array){
                                

                               $total = $array->total + $total;
                             

                              }
                              if(count($object->array)!=0){
                               if($total != 0){
                                $newCentroid = $total / count($object->array);
                                $object->centroid = $newCentroid;
                                //echo 'new centroid '.$object->centroid;
                               }
                                //echo ' object centroid cc'.count($object->array).'total ='.$total;
                              }else{

                              }
                              
                             
                            }
                                
                                 // dd($objects);
                                
                           /* $move = false;*/

                           $test++;

                          }while($move == true);
                            
                        
                       // echo count($volObj);
                          //dd($objects);
                          $criteria = Activitycriteria::where('activity_id',$activity->activity_id)->get();
                          
                         // $this->createTable($objects,$activity,$criteria,$criteria);
                          
                         
                         return $objects;
                        //return response()->json($volObj);

    }

       public function sendNotifications($activity){

        $tokens = array();

       // foreach($activities as $activity){

          $volunteers = \DB::table('volunteeractivities')->select('volunteers.*')
                                                               ->join('volunteers','volunteers.volunteer_id','=','volunteeractivities.volunteer_id')
                                                               ->where('volunteeractivities.activity_id',$activity->activity_id)->inRandomOrder()->get(); 

          $volunteersKeeper = array();

          $notification_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);

            foreach($volunteers as $volunteer){

                       $token = $volunteer->fcm_token;

                            if($token != null){
                                $notification_user_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);

                                Notification_user::create([
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
                            $foundationName = "Ethelon";

                            $body = 'Your groupmates have been revealed for '.$activity->name.' activity';
 
                          $notificationBuilder = new PayloadNotificationBuilder($activity->name);
                          $notificationBuilder->setBody($body)
                                              ->setSound('default'); 

                             $dataBuilder = new PayloadDataBuilder();
                             $dataBuilder->addData([
                                
                                'eventImage'=>$activity->image_url,
                                'eventHost' =>"Ethelon",
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

     public function createTable($objects,$activity,$criteria){
      foreach($objects as $object){
         $count = 0;
         $id = null;
         $volunteerCount = count($object->array);
         


         foreach($object->array as $array){

                    $this->create_volunteer_criteria_points2($activity,$array->volunteer->volunteer_id,$criteria);
         // $volunteerCount = 0;

            if($count == 0 ){
                $id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);
                 Activitygroup::create([
                  'id'=>$id,
                  'activity_id'=>$activity->activity_id,
                  'type'=>'clustered'
                  
                ]);

                 Volunteergroup::create([
                    'activity_groups_id'=>$id,
                     'volunteer_id'=>$array->volunteer->volunteer_id
                  ]);

            }else{

                 Volunteergroup::create([
                    'activity_groups_id'=>$id,
                     'volunteer_id'=>$array->volunteer->volunteer_id
                  ]);

            }
            $count++;
            if($count == $volunteerCount){
              \DB::table('activitygroups')->where('id',$id)->update([
                  'numOfVolunteers'=>$count
                ]);
              echo 'count = '.$count . ' volunteerCount '.$volunteerCount;
            }
         }

      }
      
    }

    public function create_volunteer_criteria_points2($activity, $volunteer_id,$criterias){

     
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
                                      'activity_id'=>$activity->activity_id,
                                      'type'=>'none'  
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
                                      'activity_id'=>$activity->activity_id,
                                      'type'=>'none'  
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
                      $this->sendNotifications($activity);
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
    }

    public function skill($activity){

      $volunteers = Volunteeractivity::where('activity_id',$activity->activity_id)->get();
      
      $asq = $this->sort($activity,$volunteers);
      //$this->sendNotifications($activity);
     Activity::where('activity_id',$activity->activity_id)->update(['status'=>true]);      
     // $this->info('FUCKCKCK');
     // $asq = $this->groupVolunteers($volunteers_with_no_match,$activity);

      return $asq;

    }

    public function sort($activity,$volunteers){

      $allVolunteers = $volunteers;
      $noMatches = array();
      $yesMatches = array();
      $skills = Activityskill::where('activity_id',$activity->activity_id)->get();

      if(count($allVolunteers) == 2){

        $rets1 = $this->group($allVolunteers,$activity,'none');

      }else{

         foreach($allVolunteers as $allVolunteer){

        $volunteerSkills = Volunteerskill::where('volunteer_id',$allVolunteer->volunteer_id)->get();
        

        $matches = false;
        $skwa = null;

          foreach($skills as $skill){

             foreach($volunteerSkills as $volunteerSkill){
                $skwa = $allVolunteer;
               if(strcasecmp($skill->name , $volunteerSkill->name)==0){
                                   
                                    $matches = true;
                                     //echo $allVolunteer->volunteer_id.$skill->name .' =========  ';
                                    break;
                                        
                  }
             }

          }

        if($matches == false ){
          
           array_push($noMatches,$allVolunteer);
        }else{
          
           array_push($yesMatches,$allVolunteer);
        }

      }

    

      if(count($noMatches) == 1){

      }

      if(count($yesMatches) == 1){

      }


     // return count($noMatches). ' '.count($yesMatches);

      $atay = array();

      $rets1 = $this->group($noMatches,$activity,'none');
      array_push($atay, $rets1);
      $rets2 = $this->groupMatches($yesMatches,$activity);
    //  array_push($atay, $rets2);

      return $atay;
      }
    
     

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
                          //echo $volunteer->volunteer_id. ' = '.$skill->name. "  ******** "; 
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

    public function group($volunteers, $activity, $skillName){

    //$volunteers = Volunteeractivity::where('activity_id',$activity->activity_id)->inRandomOrder()->get();
                
                $vol_per_group = $activity->group; 
                $count = 0;
                $countforId = 1;
                $id = '';
                $volunteerCount = 0;
                $lastGroup = '';  
                $lastCount = 0; 

                $numOfVolunteers = count($volunteers);
                echo $numOfVolunteers;

                    foreach($volunteers as $volunteer){

                        $this->create_volunteer_criteria_points($activity, $volunteer->volunteer_id);

                      if($count < $vol_per_group){//maka sud pa siya og group
                            if($count == 0){//create new group reset
                              if($numOfVolunteers == 1){

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

                              }else{
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


    protected function runScheduler()
    {
      //  $fn = $this->option('queue') ? 'queue' : 'call';



       /* 
        $activities = \DB::table('activities')->select('activities.*','foundations.name as foundation_name')
                                ->join('foundations','foundations.foundation_id','=','activities.foundation_id')
                                ->where('activities.status',false)
                                ->whereDate('activities.startDate',\Carbon\Carbon::tomorrow()->format('y-m-d'))->get();

                            if($activities->count()){

                              foreach($activities as $activity){
                                $this->randomAllocation($activity);
                              }  
                                
                            }    
*/

        //09210296430

                            //$activities_with_false_5hrs = \DB::table('activities')->select('activities.*')->where('5hrs',false)->get();
                             // $activities_with_false_5hrs = \DB::table('activities')->select('activities.*')->where('fiveHours',false)->get();

                             //  if($activities_with_false_5hrs->count()){
                             //      $this->info('ni sud if acitivites count');
                             //    echo 'ni sud activities count';
                             //      $this->addCriteriaTotal($activities_with_false_5hrs);  
                             // }else{
                             //  echo 'wala ni sud boanga';
                             // }

                            // $activities = \DB::table('activities')->select('activities.*','foundations.name as foundation_name','foundations.foundation_id as foundation_id')
                            //     ->join('foundations','foundations.foundation_id','=','activities.foundation_id')
                            //     ->where('activities.status',false)
                            //     ->get();
                                    
                                    $activities = Activity::where('activity_id','8d85f04')->get();

                                   // dd($activities);

                                if($activities->count()){
                                    //$this->info('nay sulod '.\Carbon\Carbon::now()->format('y-m-d h:i'));
                                }else{
                                    //$this->info('walay sulod '.\Carbon\Carbon::now()->format('y-m-d h:i'));
                                }

            foreach($activities as $activity){

                            //$this->info('nay sulod '.$activity->registration_deadline);
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

                       $activity_deadlineTime = \Carbon\Carbon::parse($activity->registration_deadline)->format('h:i');
                       $timeNow = \Carbon\Carbon::now()->format('h:i');
                       $formattedTime =  \Carbon\Carbon::parse($timeNow)->tz('UTC');
                       $activity_deadline = \Carbon\Carbon::parse($activity->registration_deadline)->format('y-m-d');
                       

                if($activity_deadline <= \Carbon\Carbon::now()->format('y-m-d')){
                        //$this->info('sud sa date if');

                       if($activity_deadlineTime <= $timeNow){
                           /* $this->info('==sulod pa '.$activity->name.' = '.$timeNow.' !! '.$activity_deadlineTime); 
                            $this->info('GROUPTYPE  '.$activity->group_type);   */
                           $activity = Activity::where('activity_id',$activity->activity_id)->first();
                          $this->thesis($activity);
                          /*  switch($activity->group_type){
                                case 'random': $this->randomAllocation($activity);  
                                                //$this->info('random'); 
                                               break;
                                case 'skill':  $this->skill($activity);
                                                //$this->info('skill');  
                                                echo 'skill';
                                               break;           
                            }*/


                       }else{
                           // $this->info('==wala pa');
                       }

                }else{


                }   
                                              
            }
           // $this->info('gawas pa');                                   


        /*$this->info('Running scheduler');
        Artisan::$fn('schedule:run');
        $this->info('completed, sleeping..');
        sleep($this->nextMinute());
        $this->runScheduler();*/
    }

     public function sendNotifForFiveHours($fcm_token,$criteriaTotal,$activityName,$activity_id,$newBadgePoints,$volunteer_id){
          //$this->info('ni sud sa send notif For five hours = '.$newBadgePoints);
        echo 'notifzzxz'.$volunteer_id;
        //echo $volunteer_id. ' before ani iya id';
                            $notification_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);

                            $optionBuilder = new OptionsBuilder();
                            $optionBuilder->setTimeToLive(60*20);
                            $optionBuilder->setPriority('high');

                            $body = 'You have earned additional '.$criteriaTotal.'points for the ' .$activityName. 'activity';
                          $notificationBuilder = new PayloadNotificationBuilder($activityName);
                          $notificationBuilder->setBody($body)
                                              ->setSound('default'); 

                            //$this->info('Notification body: '.$body);                  

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

                            Notification::create([
                                    'id'=>$notification_id,
                                    'title'=>$activityName,
                                    'body' => $body,
                                    'major_type'=>'criteriaTotal',
                                    'sub_type'=>'criteriaTotal',
                                    'data'=>$activity_id
                                ]);

                            $notification_user_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);

                                Notification_user::create([
                                       'id'=>$notification_user_id,
                                       'notification_id' => $notification_id,
                                       'sender_id'=> $activity_id,
                                       'receiver_id'=>$volunteer_id,
                                       'date'=> \Carbon\Carbon::now()->format('Y-m-d h:i')
                                    ]);

                            $downstreamResponse = FCM::sendTo($fcm_token, $option, $notification, $data); 
                            dd($downstreamResponse);

                                          

    }

    public function addCriteriaTotal($activities_with_false_5hrs){

     

      foreach($activities_with_false_5hrs as $activity_with_false_5hrs){
       // $this->info('nisulod sa foreach');
        /* $this->info('nisulod sa addcriteria Total function foreach'. \Carbon\Carbon::now(). ' add hours 5 = '.\Carbon\Carbon::parse($activity_with_false_5hrs->endDate)->addHours(5));*/

        // echo ' fuck naa'. '  '. \Carbon\Carbon::parse($activity_with_false_5hrs->endDate) . '  now = ' . \Carbon\Carbon::now();

          if(\Carbon\Carbon::parse($activity_with_false_5hrs->endDate)->addHours(5) <=  \Carbon\Carbon::now()){
         /*   $this->info('nisulod sa condtion endTime + 5 hours <= karon'. \Carbon\Carbon::now(). ' add hours 5 = '.\Carbon\Carbon::parse($activity_with_false_5hrs->endDate)->addHours(5));*/
              //echo ' fuck naa'. '  '. \Carbon\Carbon::parse($activity_with_false_5hrs->endDate) . '  now = ' . \Carbon\Carbon::now();

         echo 'NI SUD SA IF ATAYA';

         //dd($activity_with_false_5hrs);

             $volunteers = \DB::table('volunteers')->select('volunteers.*')
                                                ->join('volunteeractivities','volunteeractivities.volunteer_id','=','volunteers.volunteer_id')
                                                ->where('volunteeractivities.activity_id',$activity_with_false_5hrs->activity_id)
                                                ->where('volunteeractivities.status',true)
                                                ->get(); 



              $activityskills = Activityskill::where('activity_id',$activity_with_false_5hrs->activity_id)->get();                                    //dd($activityskills);

                   
                    foreach($volunteers as $volunteer){

                         $vol = Volunteerbadge::where('volunteer_id',$volunteer->volunteer_id)->get();
                         $asd = array("skill"=>$activityskills,"badges"=>$vol);
                         //dd($asd);
                         


                       $volunteercriteriapoints = Volunteercriteriapoint::where('volunteer_id',$volunteer->volunteer_id)
                                                                          ->where('activity_id',$activity_with_false_5hrs->activity_id)
                                                                          ->get();


                                        $criteriaTotal = 0;

                       foreach($volunteercriteriapoints as $Volunteercriteriapoint){

                            $criteriaTotal = $Volunteercriteriapoint->average_points + $criteriaTotal;
                            //$this->info('criteriaTotal = '.$criteriaTotal);
                       }
                      
                        foreach($activityskills as $activityskill){

                                $volunteerbadge = Volunteerbadge::where('volunteer_id',$volunteer->volunteer_id)
                                                                ->where('skill',$activityskill->name)
                                                                ->first();

                                                                if($volunteerbadge->count()){

                                                                }else{
                                                                     dd($volunteerbadge); 
                                                                }
                                                              
                                                                 
                                $newBadgePoints = $volunteerbadge->points + $criteriaTotal;
                                echo 'New Badge points '. $newBadgePoints;
                                 //$this->info('New badge points  = '.$newBadgePoints); 
                                $volunteerbadge = Volunteerbadge::where('volunteer_id',$volunteer->volunteer_id)
                                                                ->where('skill',$activityskill->name)
                                                                ->update(['points'=>$newBadgePoints]);

                                $totalVolPoints = $volunteer->points + $criteriaTotal;
                                //$this->info('New Volunteer points  = '.$totalVolPoints); 
                                echo 'New volunteer ponits ='.$totalVolPoints;                                 
                                Volunteer::where('volunteer_id',$volunteer->volunteer_id)->update(['points'=>$totalVolPoints]);                                 
                        }     

                         $this->sendNotifForFiveHours($volunteer->fcm_token,$criteriaTotal,$activity_with_false_5hrs->name,$activity_with_false_5hrs->activity_id,$newBadgePoints,$volunteer->volunteer_id);                                                   
                    }  
                     //$this->info('iya nang i update to true'); 
                     echo 'iya naung i update to true';
                     $activities_with_false_5hrs = \DB::table('activities')->select('activities.*')->update(['fiveHours'=>true]);                           

          }else{
            echo 'wala ni sud sa katong if sa 5 hours';
          }

         
     }

    } 

    /**
     * Works out seconds until the next minute starts;
     *
     * @return int
     */

    protected function nextMinute()
    {
        $current = Carbon::now();
        return 60 -$current->second;
    }

    public function createGroups(){

    }

    /* $activity_group_id = \DB::table('activitygroups')->select('activitygroups.*')
                                                        ->join('volunteergroups','volunteergroups.activity_groups_id','=','activitygroups.id')
                                                        ->where('volunteergroups.volunteer_id',$volunteer->volunteer_id)
                                                        ->where('activitygroups.activity_id',$activity->activity_id)
                                                        ->first();

                $volunteersToRate = \DB::table('users')->select('users.name','volunteers.volunteer_id','volunteers.image_url')
                                                ->join('volunteers','volunteers.user_id','=','users.user_id')
                                                ->join('volunteergroups','volunteergroups.volunteer_id','=','volunteers.volunteer_id')
                                                ->where('volunteergroups.activity_groups_id',$activity_group_id->id)
                                                ->where('volunteergroups.volunteer_id','!=',$volunteer->volunteer_id)
                                                ->get();   */


                /*     foreach($volunteersToRate as $volunteerToRate){

                             $data = array("name"=>$volunteerToRate->name,
                                            "volunteer_id"=>$volunteerToRate->volunteer_id,
                                            "image_url"=>$volunteerToRate->image_url,
                                            "activity_group_id"=>$activity_group_id->id,
                                            "num_of_vol"=>$activity_group_id->numOfVolunteers);

                             array_push($volunteersKeeper,$data);
                     } */                        

}
