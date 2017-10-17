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


    public function deleteall(){
     
    /* \DB::table('users')->delete();
    \DB::table('foundations')->delete();
    \DB::table('volunteers')->delete();
    \DB::table('activityskills')->delete();
    \DB::table('volunteergroups')->delete();
    \DB::table('volunteeractivities')->delete();

    \DB::table('groupnotifications')->delete();
    \DB::table('volunteerbeforeactivities')->delete();
    \DB::table('volunteerafteractivities')->delete();
    \DB::table('activitycriterias')->delete();
    \DB::table('volunteercriteriapoints');
    \DB::table('volunteerskills')->delete();
    \DB::table('volunteeractivities')->delete();
    \DB::table('activitygroups')->delete();
    \DB::table('volunteercriterias')->delete();
    \DB::table('groupnotifications')->delete();
    \DB::table('activities')->delete();*/

    Volunteer::where('volunteer_id','08ab5fe')->delete();
    User::where('user_id','1877377522288783')->delete();
    Volunteerskill::where('volunteer_id','08ab5fe')->delete();

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
                          \DB::table('activities')->delete();
                          \DB::table('activityskills')->delete();
                          \DB::table('activitygroups')->delete();
                          \DB::table('volunteeractivities')->delete();
                          \DB::table('volunteergroups')->delete();

                      

    }

    public function test3(){
      
      //$volunteers = Volunteer::all();
     /* $skills = Volunteerskill::where('volunteer_id','b5feb04')->get();
      return response()->json($skills);*/



/*
  Volunteeractivity::create([
                 'volunteer_id'=>'b2b66de',
                 'activity_id'=>'7ca34a3',
                 'status'=> false  
                ]);

*/
      
      

/*
      foreach($volunteers as $volunteer){
        Volunteeractivity::create([
                 'volunteer_id'=>$volunteer->volunteer_id,
                 'activity_id'=>'7fcdd46',
                 'status'=> false  
                ]);
      }*/

       

       // $volunteerTokens = Volunteer::pluck('fcm_token')->toArray();

                            $optionBuilder = new OptionsBuilder();
                            $optionBuilder->setTimeToLive(60*20);
                            $optionBuilder->setPriority('high');

                            $kobe = 'kobe';

                             $body = 'Your groupmates have been revealed for '.$kobe.' activity';
 
                          $notificationBuilder = new PayloadNotificationBuilder('Ethelon');
                          $notificationBuilder->setBody('Vincent Ramas bayot')
                                              ->setSound('default'); 

                            $dataBuilder = new PayloadDataBuilder();
                             $dataBuilder->addData([
                               'FuckShit'    => "Fuck?" 
                                ]);


                            $option = $optionBuilder->build();
                            $notification = $notificationBuilder->build();
                           // $data = $dataBuilder->build();

                            $downstreamResponse = FCM::sendTo('ffQ_FPL2P24:APA91bFvQbvj1IcdPRlOiC-BEtAYGH2crG-dcU-qMHgxpAq-2N7y26e9YUDnDOxd8uPQbcKLd1xxOylTw1PPZuYEE4zUepevfh4pXyF4iauOs_fDZjGjp48_Epa_er_H1vpiB0RsCAmO', $option, $notification, null);

                            dd($downstreamResponse);


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

    public function runSchedulerz(){

  
       $activities = \DB::table('activities')->select('activities.*','foundations.name as foundation_name')
                                ->join('foundations','foundations.foundation_id','=','activities.foundation_id')
                                ->where('activities.status',false)
                                ->where('activity_id','fd95d06')->get();




            foreach($activities as $activity){



              $this->randomAllocation($activity);

            }

              /*
                 $date = substr($activity->startDate, 0,strpos($activity->startDate, ' ')); 
                  $datesaved = $date. ' '.$activity->start_time;
                   $date5minutes = \Carbon\Carbon::parse($datesaved)->addMinute(5)->format('y-m-d h:i');

                    if($date5minutes == \Carbon\Carbon::now()->addMinute(5)->format('y-m-d h:i') || $date5minutes > \Carbon\Carbon::now()->format('y-m-d h:i')){
                         
                         return 'sulod sa if';
                       // 
                        
                    }else{

                        
                        return 'wala';
                      }
                 
                  }                                   */
                              

               // dd($activities->start_time);
              
               // return $datesaved;

               // return $date5minutes.(string)\Carbon\Carbon::now()->addMinute(5)->format('y-m-d h:i');


    }

  
    public function randomAllocation($activity){

     /* foreach($activity as $activity){*/

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
                    //}

                  return $this->sendNotifications($activity);
            
    }

 public function sendNotifications($activity){

        $tokens = array();

       // foreach($activities as $activity){

          $volunteers = \DB::table('volunteeractivities')->select('volunteers.*')
                                                               ->join('volunteers','volunteers.volunteer_id','=','volunteeractivities.volunteer_id')
                                                               ->where('volunteeractivities.activity_id',$activity->activity_id)->inRandomOrder()->get(); 

          $volunteersKeeper = array();

            foreach($volunteers as $volunteer){

                
                       $token = $volunteer->fcm_token;


                            if($token != null){

                                 //$downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
                                 //array_push($downstreamResponseArray,$downstreamResponse);
                                array_push($tokens,$token);


                             }else{

                                Groupnotification::create([
                                    'volunteer_id'=>$volunteer->volunteer_id,
                                    'activity_id'=>$activity->activity_id,
                                    'date'=>\Carbon\Carbon::now()->format('Y-m-d')
                                    ]);

                            }
                           
             }


                            $optionBuilder = new OptionsBuilder();
                            $optionBuilder->setTimeToLive(60*20);
                            $optionBuilder->setPriority('high');

                            $body = 'Your groupmates have been revealed for '.$activity->name.' activity';
 
                          $notificationBuilder = new PayloadNotificationBuilder('Ethelon');
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

                            $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
                             
      
            Activity::where('activity_id',$activity->activity_id)->update(['status'=>true]);
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


