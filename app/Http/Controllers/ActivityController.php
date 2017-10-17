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

use Davibennun\LaravelPushNotification\Facades\PushNotification;

use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\App;

class ActivityController extends Controller
{


public function webtest($id){

    /*$code = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAUAAAAFACAIAAABC8jL9AAAgAElEQVR4nO19rZMdx/V237d+G6AAC0hEBmuwdlUCLLKhEomrNgEKMBeJgQMk/wORgZ1/QDIRkIm4icA6VUYS9RKHqEoW8BIRCchEZKvUL5hS17nnq093n57pu5oHbM2d6Tn9TPf56jMzO5s');
        
    $ncode = (string)$code;
    echo $code;*/
/*
    $qrCode = new QrCode($id);
    $qrCode
    ->setWriterByName('png')
    ->setMargin(10)
    ->setEncoding('UTF-8')
    ->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH)
    ->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0])
    ->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255])
    ->setLogoWidth(150)
    ->setValidateResult(false);

    header('Content-Type: '.$qrCode->getContentType());
    echo (string)$qrCode->writeString();*/

    echo \QrCode::size(400)->generate($id);
    //return view('test.test',compact('code'));
}

 public function deleteall(){
    
    //\DB::table('users')->delete();
    //\DB::table('foundations')->delete();
    //\DB::table('volunteers')->delete();
    //\DB::table('activityskills')->delete();
    \DB::table('volunteergroups')->delete();
    //\DB::table('volunteerbeforeactivities')->delete();
    //\DB::table('volunteerafteractivities')->delete();
    //\DB::table('activitycriterias')->delete();
    \DB::table('volunteercriteriapoints');
    //\DB::table('volunteerskills')->delete();
   // \DB::table('volunteeractivities')->delete();
    \DB::table('activitygroups')->delete();
   // \DB::table('volunteercriterias')->delete();
    \DB::table('groupnotifications')->delete();
    //\DB::table('activities')->delete();

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

public function test4(){

  /*$volunteers = Volunteer::all();

  foreach($volunteers as $volunteer){
      Volunteeractivity::create([
            'activity_id' => '6b1d8fe',
            'volunteer_id'=> $volunteer->volunteer_id,
            'status' => false
            ]);
    }*/
    
    // $activity = Activity::where('activity_id','6b1d8fe')->first();
    // $volunteer = Volunteer::all();
                                                        
                            $optionBuilder = new OptionsBuilder();
                            $optionBuilder->setTimeToLive(60*20);
                            $optionBuilder->setPriority('high');
 
                          $notificationBuilder = new PayloadNotificationBuilder('Ethelon');
                          $notificationBuilder->setBody('Your groupmates has been revealed')
                                              ->setSound('default'); 

                            $dataBuilder = new PayloadDataBuilder();

                          /*  $dataBuilder->addData([
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

                              $dataBuilder->addData([
                                "asds"=>"dsd"  
                                
                                ]);

                            $option = $optionBuilder->build();
                            $notification = $notificationBuilder->build();
                            $data = $dataBuilder->build();
                             
                        
                                 $downstreamResponse = FCM::sendTo('dU7P0ilocYo:APA91bGF9ydcXb4osmAz1y-8CdPhHiYhn_vt3Zg9Nt8rz5KO1XwwMgt5z5TYKZn5QECs1DdY5CJ-xYUgcQWqpTxYt9E0oMCktcJeKBzDZX1n1pRc2P7qjPagMqfxFJVYZrH_Pba18DbQ', $option, $notification, $data);

                                 return response()->json($downstreamResponse);

                   /*               $optionBuilder = new OptionsBuilder();
                            $optionBuilder->setTimeToLive(60*20);
                            $optionBuilder->setPriority('high');
 
                          $notificationBuilder = new PayloadNotificationBuilder('Ethelon');
                          $notificationBuilder->setBody('Your groupmates has been revealed')
                                              ->setSound('default'); 

                            $dataBuilder = new PayloadDataBuilder();
                            $dataBuilder->addData([
                                "sds"=>"dsds"
                                
                                ]);

                            $option = $optionBuilder->build();
                            $notification = $notificationBuilder->build();
                            $data = $dataBuilder->build();
                             
                        
                                 $downstreamResponse = FCM::sendTo('fz58IBx65j0:APA91bHr3Bz__NOpnfIEVpifvCkVNSMtJeZidl7OHAm-FHt0eLLsIje_pwMKzh6MHTTCkOB9RLscaYbnqChSqw_iubcnlQsW1GdNi_3qbVjYNBN4lcGk4Fb9_2g3GmiyBc-l8srOI7d4', $option, $notification, $data);

                                 dd($downstreamResponse);*/

}

public function test3(){

     /* $activities = Activity::where('status',false)->get();

      if($activities->count()){

         $this->randomAllocation($activities);  
        
      }else{
        return 'atay';
      }*/

      $volunteers = Volunteer::all();

      foreach($volunteers as $volunteer){

       Volunteeractivity::create([
        
                 'volunteer_id'=>$volunteer->volunteer_id,
                 'activity_id'=>'a277327',
                 'status'=> false  
                ]);
            
      }
      
/*
      Activityskill::create([
          'activity_id'=> '6b1d8fe',
          'name'=> 'Sports'
        ]);

        Activityskill::create([
          'activity_id'=> '6b1d8fe',
          'name'=> 'Culinary'
        ]);
*/
}


  public function test2(){

    //Activity::whereDate('startDate',\Carbon\Carbon::tomorrow()->format('Y-m-d'))->update(['status'=> true]);


    //$activities = Activity::whereDate('startDate',\Carbon\Carbon::tomorrow()->format('Y-m-d'))->get();*/
/*
    $activities = Activity::where('activity_id','d7a75')->get();

     $this->randomAllocation($activities);
     $this->sendNotifications($activities);*/

//fz58IBx65j0:APA91bHr3Bz__NOpnfIEVpifvCkVNSMtJeZidl7OHAm-FHt0eLLsIje_pwMKzh6MHTTCkOB9RLscaYbnqChSqw_iubcnlQsW1GdNi_3qbVjYNBN4lcGk4Fb9_2g3GmiyBc-l8srOI7d4

    /*$optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        $optionBuilder->setPriority('high');

        $notificationBuilder = new PayloadNotificationBuilder('Ethelon');
                          $notificationBuilder->setBody('Your groupmates for  has been revealed')
                                              ->setSound('default'); 

                            $dataBuilder = new PayloadDataBuilder();
                            $dataBuilder->addData([
                                'activity'=>'wew',
                                'volunteersToRate'=>'yawa'
                                ]);
                              
                             $option = $optionBuilder->build();
                             $notification = $notificationBuilder->build();
                             $data = $dataBuilder->build();

                             $downstreamResponse = FCM::sendTo('fz58IBx65j0:APA91bHr3Bz__NOpnfIEVpifvCkVNSMtJeZidl7OHAm-FHt0eLLsIje_pwMKzh6MHTTCkOB9RLscaYbnqChSqw_iubcnlQsW1GdNi_3qbVjYNBN4lcGk4Fb9_2g3GmiyBc-l8srOI7d4', $option, $notification, $data);

                             return dd($downstreamResponse);*/


        $activities = Activity::where('status',false)->get();

      if($activities->count()){
        
        $this->randomAllocation($activities);  

        $returns = $this->sendNotifications($activities);

        return response()->json($returns);
      }

  }

  public function sendnoTif(){
    $volunteers = Volunteer::all();


    $downstreams = array();
    foreach($volunteers as $volunteer){

      if($volunteer->fcm_token != null){

                            $optionBuilder = new OptionsBuilder();
                            $optionBuilder->setTimeToLive(60*20);
                            $optionBuilder->setPriority('high');
 
                          $notificationBuilder = new PayloadNotificationBuilder('Emperador');
                          $notificationBuilder->setBody('HANNAH ASANG TAGAY??????')
                                              ->setSound('default'); 

                            $dataBuilder = new PayloadDataBuilder();
                            $dataBuilder->addData([
                                'activity'=>'fasds',
                                'volunteersToRate'=>'few'
                                ]);

                            $option = $optionBuilder->build();
                            $notification = $notificationBuilder->build();
                            $data = $dataBuilder->build();
                             
                            
                            $downstreams = FCM::sendTo($volunteer->fcm_token, $option, $notification, $data);
               }

            }
            return 'kayata';
     return response()->json($downstreams);
  }

 public function randomAllocation($activities){
        
     
      foreach($activities as $activity){

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
                    }   


                     $this->sendNotifications($activities);



    }



 public function sendNotifications($activities){

      
        $downstreams = array();
       
        $jsons = array();

        foreach($activities as $activity){

          $volunteers = \DB::table('volunteeractivities')->select('volunteers.*')
                                                               ->join('volunteers','volunteers.volunteer_id','=','volunteeractivities.volunteer_id')
                                                               ->where('volunteeractivities.activity_id',$activity->activity_id)->inRandomOrder()->get(); 
    
                                                           
          $volunteersKeeper = array();
          $groupmates = array();
          $activity_group_ids= array();
          $volunteersToRates = array();

            foreach($volunteers as $volunteer){

                $activity_group_id = \DB::table('activitygroups')->select('activitygroups.*')
                                                        ->join('volunteergroups','volunteergroups.activity_groups_id','=','activitygroups.id')
                                                        ->where('volunteergroups.volunteer_id',$volunteer->volunteer_id)
                                                        ->where('activitygroups.activity_id',$activity->activity_id)
                                                        ->first();

                $volunteersToRate = \DB::table('users')->select('users.name','volunteers.volunteer_id','volunteers.image_url')
                                                ->join('volunteers','volunteers.user_id','=','users.user_id')
                                                ->join('volunteergroups','volunteergroups.volunteer_id','=','volunteers.volunteer_id')
                                                ->where('volunteergroups.activity_groups_id',$activity_group_id->id)
                                                ->where('volunteergroups.volunteer_id','!=',$volunteer->volunteer_id)
                                                ->get();   

                           array_push($volunteersToRates,$volunteersToRate);       
                           array_push($activity_group_ids,$activity_group_id);                  


                     foreach($volunteersToRate as $volunteerToRate){

                             $data = array("name"=>$volunteerToRate->name,
                                            "volunteer_id"=>$volunteerToRate->volunteer_id,
                                            "image_url"=>$volunteerToRate->image_url,
                                            "activity_group_id"=>$activity_group_id->id,
                                            "num_of_vol"=>$activity_group_id->numOfVolunteers);

                             array_push($volunteersKeeper,$data);

                     }                           



                            $optionBuilder = new OptionsBuilder();
                            $optionBuilder->setTimeToLive(60*20);
                            $optionBuilder->setPriority('high');
 
                          $notificationBuilder = new PayloadNotificationBuilder('Ethelon');
                          $notificationBuilder->setBody('Your groupmates has been revealed')
                                              ->setSound('default'); 

                            $dataBuilder = new PayloadDataBuilder();
                            $dataBuilder->addData([
                                'activity'=>'s',
                                'volunteersToRate'=>'we'
                                ]);

                            $option = $optionBuilder->build();
                            $notification = $notificationBuilder->build();
                            $data = $dataBuilder->build();
                             
                            $token = $volunteer->fcm_token;

                            if($token != null){

                                 $downstreams = FCM::sendTo($token, $option, $notification, $data);

                             }else{

                                Groupnotification::create([
                                    'volunteer_id'=>$volunteer->volunteer_id,
                                    'activity_id'=>$activity->activity_id,
                                    'date'=>\Carbon\Carbon::now()->format('Y-m-d')
                                    ]);

                             }
                           

            }
        }
        
       
        return response()->json(array("downstreas"=>$downstreams, "volunteerstoRate"=>$volunteersToRates, "activity_groups"=>$activity_group_ids));

    }


  public function test(Request $request){



        $volunteers = Volunteer::all();

    /*    foreach($volunteers as $volunteer){
            Volunteerbeforeactivity::create([
                'activity_id'=>'d7a75',
                'volunteer_id' => $volunteer->volunteer_id]);
        }*/
        foreach($volunteers as $volunteer){
            Volunteeractivity::create([
                'volunteer_id'=> $volunteer->volunteer_id,
                'activity_id'=>'d7a75',
                'status'=>false
                ]);
        }

        return "good";

   
         $activity = Activity::where('activity_id','ecbb19a')->first();

                $volunteers = Volunteerbeforeactivity::where('activity_id',$activity->activity_id)->inRandomOrder()->get();
                
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

    
    $groups = Activitygroup::all();
    return response()->json($groups);


  }
    
    public function index()
    {
      if(\Auth::user()->foundation)
      {
          $activities = \Auth::user()->foundation->activities;
          $volunteersArray = array();
          $eachActivityArray = array();

          foreach($activities as $activity){

                $volunteersQuery = \DB::table('users')->select('volunteers.image_url as image_url')
                                           ->join('volunteers','volunteers.user_id','=','users.user_id')
                                           ->join('volunteeractivities','volunteeractivities.volunteer_id','=','volunteers.volunteer_id')
                                           ->where('volunteeractivities.activity_id',$activity->activity_id)
                                           ->inRandomOrder()
                                           ->get();

                                           $Volunteers = array($activity->activity_id=>$volunteersQuery);

                                           array_push($volunteersArray,$Volunteers);
          }

         /* $volunteersArray = json_encode($volunteersArray);
          return response($volunteersArray);*/

      }
      else
      {
          $activities = null;
          $volunteers = null;
      }
      return view('activity.activityIndex', compact('activities', 'volunteersArray'));
    }
    
    public function create()
    {
        return view('activity.activityCreate');
    }

    public function store(Request $request)
    {


        $dt = new \DateTime($request->input('startDate').' '.$request->input('startTime'));
        $sd = Carbon::instance($dt);
        $dtt = new \DateTime($request->input('endDate').' '.$request->input('endTime'));
        $ed = Carbon::instance($dtt);
        $url = $this->uploadFile($request->file('file'));
        $activity_id_store = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);

        $start_time = \Carbon\Carbon::parse($request->input('startTime'));   
        $end_time =   \Carbon\Carbon::parse($request->input('endTime')); 

        $numOfHours = $start_time->diffInHours($end_time);

        $preSetPoints = 5*$numOfHours;
        
        $activityId = Activity::create([
            "activity_id" => $activity_id_store, 
            "foundation_id" => \Auth::user()->foundation->foundation_id,
            "name" => $request->input('activityName'),
            "image_url" => $url,
            "imageQr_url" =>'',
            "description" => $request->input('activityDescription'),
            "location" => $request->input('activityLocation'),
            "start_time" => $request->input('startTime'),
            "end_time" => $ed->toTimeString(),
            "endDate" => $ed,
            "group" => $request->input('group'),
            "long" => $request->input('long'),
            "lat" => $request->input('lat'),
            "points_equivalent" => $preSetPoints,
            "status" => 0,
            "startDate" => $sd->toDateTimeString(),
            "contactperson" => $request->input('contactPerson'),
            "contact" => $request->input('contactInfo'),
            "startDate" => $sd
        ])->activity_id;
        
        foreach($request->input('criteria') as $criterion)
        {
            Activitycriteria::create([
               "activity_id" => $activityId,
                "criteria" => $criterion
            ]);
        }
        
        foreach($request->input('activitySkills') as $skill)
        {
            Activityskill::create([
                "name" => $skill,
                "activity_id" => $activityId
            ]);
        }
        
        return redirect(url('/activity'));
    }

/*    public function uploadQr($activity_id){

            
            $filename = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);
            $destinationPath = public_path('file_attachments');

             
  
            // $qrCode->move($destinationPath, $filename);   

            
             
             \Cloudder::upload(url('/file_attachments').'/'.$filename);

            $url = \Cloudder::getResult();
            
            if($url){

                return $url['url'];

            }

      
   
    }*/

    public function uploadFile($file)
    {
        $extension = $file->clientExtension();
        $destinationPath = public_path('file_attachments');
        
        if($extension != "bin")
        {

            $destinationPath = public_path('file_attachments');
            $filename = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$file->getClientOriginalName();
            
            $file->move($destinationPath, $filename);
         
            \Cloudder::upload(url('/file_attachments').'/'.$filename);

            $url = \Cloudder::getResult();
            
            if($url){

               return $url['url'];

            }
            
        }
        else
        {
            $files = public_path('assets/images/ethelon.png');
            return $file;
        }
        
    }
            
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

    public function activityList()
    {
      $activities = Activity::all();

      return view('activity.adminActivityList', compact('activities'));
    }

    //to view a specific activity
    public function view($id)
    {
      $activity = Activity::find($id);
      //dd($activity->skills[0]->name);
      return view('activity.activityView', compact('activity'));
    }

    public function edit($id)
    {
      $activity = Activity::find($id);

      return view('activity.activityEdit', compact('activity'));
    }

    public function delete($id)
    {
      Activity::destroy($id);
      
      return redirect(url('/activity'));
    }

    //

	//get volunteers that said they will join
    public function getVolunteersBefore(Request $request){

    	$activity_id = $request->input('activity_id');


        $volunteersBefore = \DB::table('users')->select('users.name as name','volunteers.image_url as image_url')
                                           ->join('volunteers','volunteers.user_id','=','users.user_id')
                                           ->join('volunteeractivities','volunteeractivities.volunteer_id','=','volunteers.volunteer_id') 
                                           ->where('volunteeractivities.activity_id',$activity_id)
                                           ->get();

    	return response()->json($volunteersBefore);
        
    }

    //get volunteers that joined and captured the qr code
    public function getVolunteersAfter(Request $request){
        
    	$activity_id = $request->input('activity_id');

    	//$volunteersAfter = Volunteerafteractivity::where('activity_id',$activity_id)->get();

        $volunteersAfter = \DB::table('volunteers')->select('volunteers.*')->join('volunteerafteractivities','volunteerafteractivities.volunteer_id','=','volunteers.volunteer_id')->where('volunteerafteractivities.activity_id',$activity_id)->get();

    	return response()->json($volunteersAfter);

    }

    //get activities nga not done
    public function getActivitiesNotDone(Request $request){

        $matches = 0;
        $activityKeeper = array();
        $activityScores = array();
        $newActivities = array();
        

        $activities = \DB::table('activities')->select('activities.*','users.name as foundtion_name','foundations.image_url as      foundation_imageurl') 
                                              ->join('foundations','foundations.foundation_id','=','activities.foundation_id') 
                                              ->join('users','users.user_id','=','foundations.user_id') 
                                              ->where('activities.status',false)->get();  

        $skills = Volunteerskill::where('volunteer_id',$request->input('volunteer_id'))->get();


            foreach($activities as $activity){
                $count = 0; 

                    $activityskills = Activityskill::where('activity_id',$activity->activity_id)->get();

                    $watch = Volunteeractivity::where('volunteer_id',$request->input('volunteer_id'))
                                       ->where('activity_id',$activity->activity_id)->get();

                    $activityCriteria = Activitycriteria::where('activity_id',$activity->activity_id)->get();                   

                    $volunteerCount = Volunteeractivity::where('activity_id',$activity->activity_id)->get();                   

                    if($watch->count()){
                        $data = "yes";
                    }else{
                        $data = "no";
                    }


                    $activityTempo = array("activity_id"=>$activity->activity_id,
                                            "foundation_id"=>$activity->foundation_id,
                                            "name"=>$activity->name,
                                            "image_url"=>$activity->image_url,
                                            "imageQr_url"=>$activity->imageQr_url,
                                            "description"=>$activity->description,
                                            "location"=>$activity->location,
                                            "start_time"=>$activity->start_time,
                                            "end_time"=>$activity->end_time,
                                            "group"=>$activity->group,
                                            "long"=>$activity->long,
                                            "lat"=>$activity->lat,
                                            "points_equivalent"=>$activity->points_equivalent,
                                            "status"=>$activity->status,
                                            "created_at"=>$activity->created_at,
                                            "updated_at"=>$activity->updated_at,
                                            "contactperson"=>$activity->contactperson,
                                            "contact"=>$activity->contact,
                                            "startDate"=>$activity->startDate,
                                            "foundtion_name"=>$activity->foundtion_name,
                                            "volunteerstatus"=>$data,
                                            "foundation_img" =>$activity->foundation_imageurl,
                                            "volunteer_count"=>$volunteerCount->count(),
                                            "activity_skills"=>$activityskills,
                                            "activity_criteria"=>$activityCriteria
                                            );                     

                    foreach($activityskills as $activityskill){

                            foreach($skills as $skill){

                                if($skill->name == $activityskill->name){

                                    $matches = $matches + 1;
                                    break;
                                        
                                }
                            }//innermost foreach

                    }//2nd foreach
                
                    array_push($activityKeeper,$activityTempo);
                    array_push($activityScores,$matches);
                    $count++;    
                    $matches = 0;

            }

            //the 2 arrays are parallel to each other

            //sort the 2 arrays accordingly
            for($j = 0; $j < count($activityScores); $j ++) {

                for($i = 0; $i < count($activityScores)-1; $i ++){

                     if($activityScores[$i] > $activityScores[$i+1]) {

                        $temp = $activityScores[$i+1];
                        $activityScores[$i+1]=$activityScores[$i];
                        $activityScores[$i]=$temp;

                        $temp2 = $activityKeeper[$i+1];
                        $activityKeeper[$i+1]=$activityKeeper[$i];
                        $activityKeeper[$i]=$temp2;
    
                        }    
                }
                
            } 

            return response()->json($activityKeeper);

    	   //return response()->json($activities);
        
    }

    public function portfolio(Request $request){
//rwquest = 5 if(5 == ) lahos ra
      //request == 10 - 5(mao niy i minus para limit)

     $offset = 0;

     $requestedOffsetString = $request->input('offset');
     $offsetInt = (int)$requestedOffsetString;
      
      if($offsetInt==5){
         $offset = 0;
      }else{
         $offset = $offsetInt - 5;
      }

       $activityList = array();

        $activities = \DB::table('activities')->select('activities.*','volunteeractivities.status as joined','volunteeractivities.points as points','foundations.name as foundation_name')->join('foundations','foundations.foundation_id','=','activities.foundation_id')->join('volunteeractivities','volunteeractivities.activity_id','=','activities.activity_id')->where('volunteeractivities.volunteer_id',$request->input('volunteer_id'))->orderBy('activities.startDate','DESC')
                ->limit(5)     
                ->get();

                foreach($activities as $activity){

                  $volunteerCount = Volunteeractivity::where('activity_id',$activity->activity_id)->get();

                  $activitySkills = Activityskill::where('activity_id',$activity->activity_id)->get();

                  $activityCriteria = Activitycriteria::where('activity_id',$activity->activity_id)->get();                   

                  $foundation = \DB::table('activities')->select('users.name as foundtion_name','foundations.image_url as  foundation_imageurl') 
                                              ->join('foundations','foundations.foundation_id','=','activities.foundation_id') 
                                              ->join('users','users.user_id','=','foundations.user_id') 
                                              ->where('activities.activity_id',$activity->activity_id)->first();  

                  $activityTempo = array("activity_id"=>$activity->activity_id,
                                            "foundation_id"=>$activity->foundation_id,
                                            "name"=>$activity->name,
                                            "image_url"=>$activity->image_url,
                                            "imageQr_url"=>$activity->imageQr_url,
                                            "description"=>$activity->description,
                                            "location"=>$activity->location,
                                            "start_time"=>$activity->start_time,
                                            "end_time"=>$activity->end_time,
                                            "group"=>$activity->group,
                                            "long"=>$activity->long,
                                            "lat"=>$activity->lat,
                                            "points_equivalent"=>$activity->points_equivalent,
                                            "status"=>$activity->status,
                                            "created_at"=>$activity->created_at,
                                            "updated_at"=>$activity->updated_at,
                                            "contactperson"=>$activity->contactperson,
                                            "contact"=>$activity->contact,
                                            "startDate"=>$activity->startDate,
                                            "foundation_name"=>$activity->foundation_name,
                                            "status"=>$activity->status,
                                            "joined"=>$activity->joined,
                                            "points"=>$activity->points,
                                            "foundation_img" =>$foundation->foundation_imageurl,
                                            "foundtion_name" =>$foundation->foundtion_name,
                                            "volunteer_count"=>$volunteerCount->count(),
                                            "activity_skills"=>$activitySkills,
                                            "activity_criteria"=>$activityCriteria);

                         array_push($activityList,$activityTempo);                          

                }

        return response()->json($activityList);

    }

    public function prac(Request $request){

    
            /*$volunteer_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);
                    $time = microtime(true);
                    $api_token = $user_id.$time;*/

                 /*    User::create([
                        'user_id'=>"shit",
                        'name'=>$request->input('name'),
                        'email'=>"Email not available",
                        'role'=> "Volunteer",
                        'api_token'=> "Pisteeeee"
                    ]);*/
                        
                      $id = $request->input("facebook_id");  
                      $name = $request->input("name");

                    $user = User::create([
                           'user_id' => $id,
                           'name' => $name,
                           'email' => "not available",
                           'role' => "Volunteer",
                           'api_token' => "poorrrasasdssdsffsdsdsd"
                        ]);
        
            return response()->json($name);
        
    }

   public function criteria(Request $request){ 

     $activity_id = $request->input('activity_id');
     $criterias  = Activitycriteria::where('activity_id',$activity_id)->get();

     return response()->json($criterias);

   }

   public function volunteersToRate(Request $request){
 
       $volunteersKeeper = array();

       $activity_group_id = \DB::table('activitygroups')->select('activitygroups.*')
                                                        ->join('volunteergroups','volunteergroups.activity_groups_id','=','activitygroups.id')
                                                        ->where('volunteergroups.volunteer_id',$request->input('volunteer_id'))
                                                        ->where('activitygroups.activity_id',$request->input('activity_id'))
                                                            ->first();

                                                           
        $volunteersToRate = \DB::table('users')->select('users.name','volunteers.volunteer_id','volunteers.image_url')
                                                ->join('volunteers','volunteers.user_id','=','users.user_id')
                                                ->join('volunteergroups','volunteergroups.volunteer_id','=','volunteers.volunteer_id')
                                                ->where('volunteergroups.activity_groups_id',$activity_group_id->id)
                                                ->where('volunteergroups.volunteer_id','!=',$request->input('volunteer_id'))
                                                ->get();   

                     foreach($volunteersToRate as $volunteerToRate){

                             $data = array("name"=>$volunteerToRate->name,
                                            "volunteer_id"=>$volunteerToRate->volunteer_id,
                                            "image_url"=>$volunteerToRate->image_url,
                                            "activity_group_id"=>$activity_group_id->id,
                                            "num_of_vol"=>$activity_group_id->numOfVolunteers);

                             array_push($volunteersKeeper,$data);
                     }                           

                                                
        return response()->json($volunteersKeeper);                       

   }

   

 

   public function successAttendanceAndPointsEarned(){

   }


}
