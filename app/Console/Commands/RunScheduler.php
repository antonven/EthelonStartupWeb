<?php

/**


This Scheduler will run once every minute unlike the Heroku scheduler which only runs every 10 mintues.

To use this scheduler with Laravel 5.4+ add this file to /app/Console/Commands/RunScheduler.php
Register this file in app/Console/Kernel.php

protected $commands = [
...
Commands\RunScheduler::class
...
]

Add this line to your Procfile:

scheduler: php -d memory_limit=512M artisan schedule:cron

Push to Heroku and you will see you have a new dyno option called Scheduler, start ONE only.

I highly recommend using Artisan::queue to run your cron jobs so that your scheduler does not over run.

*/

namespace App\Console\Commands;

use Illuminate\Console\Command;

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

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Groupnotification;

/**
 *
 * Runs the scheduler every 60 seconds as expected to be done by cron.
 * This will break if jobs exceed 60 seconds so you should make sure all scheduled jobs are queued
 *
 * Class RunScheduler
 * @package App\Console\Commands
 */
class RunScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:cron {--queue}';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the scheduler without cron (For use with Heroku etc)';
    
    /**
     * Create a new command instance.
     *
     * @    return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
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
        

        $this->info('Waiting '. $this->nextMinute(). ' for next run of scheduler');
        sleep($this->nextMinute());
        $this->runScheduler();
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
                             
      
            
           // return $downstreamResponse;
       // }

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


    protected function runScheduler()
    {
        $fn = $this->option('queue') ? 'queue' : 'call';



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

                            $activities = \DB::table('activities')->select('activities.*','foundations.name as foundation_name')
                                ->join('foundations','foundations.foundation_id','=','activities.foundation_id')
                                ->where('activities.status',false)
                                ->get();

                                if($activities->count()){
                                    $this->info('nay sulod '.\Carbon\Carbon::now()->format('y-m-d h:i'));
                                }else{
                                    $this->info('walay sulod '.\Carbon\Carbon::now()->format('y-m-d h:i'));
                                }

            foreach($activities as $activity){

                            $this->info('nay sulod '.$activity->registration_deadline);
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
                       $timeNow = \Carbon\Carbon::now()->format('H:i');
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


                }   
                                              
            }
           // $this->info('gawas pa');                                   


        $this->info('Running scheduler');
        Artisan::$fn('schedule:run');
        $this->info('completed, sleeping..');
        sleep($this->nextMinute());
        $this->runScheduler();
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
