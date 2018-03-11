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

    //  return response()->json($volunteersArray);
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
        $rt = new \DateTime($request->input('deadlineDate').' '.$request->input('deadlineTime'));
        $rtt = Carbon::instance($rt);

        
        $activity_id_store = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);

        $start_time = \Carbon\Carbon::parse($sd);   
        $end_time =   \Carbon\Carbon::parse($ed); 

        $numOfHours = $start_time->diffInHours($end_time);

        $preSetPoints = 2*$numOfHours;

        $url = $this->uploadFile($request->file('file'));
        
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
            "startDate" => $sd,
            "volunteersNeeded" => $request->input('volunteersNeeded'),
            "registration_deadline" => $rtt
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


    public function uploadFile($file)
    {
        $extension = $file->clientExtension();
        $destinationPath = public_path('file_attachments');
        
        if($extension != "bin")
        {

            $destinationPath = public_path('file_attachments');
            $filename = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$file->getClientOriginalName();
            $file->move($destinationPath,$filename);
            
          
            \Cloudder::upload(url('/file_attachments').'/'.$filename);
              
            $url = \Cloudder::getResult();
            
            if($url){

               return $url['url'];

            }
            //return url('/file_attachments').'/'.$filename;
            
            
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

    public function update(Request $request, $id)
    {

      $activity = Activity::find($id);
      foreach($activity->criteria as $criterion)
      {
        Activitycriteria::where('activity_id', $id)->where('criteria', $criterion->criteria)->delete();
      }
      foreach($activity->skills as $skill)
      {
        Activityskill::where('activity_id', $id)->where('name',$skill->name)->delete();
      }
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
      
      $activityId = Activity::where('activity_id', $id)->update([
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
          "startDate" => $sd,
          "volunteersNeeded" => $request->input('volunteersNeeded')
      ]);
      
      foreach($request->input('criteria') as $criterion)
      {
          Activitycriteria::create([
             "activity_id" => $id,
              "criteria" => $criterion
          ]);
      }
      
      foreach($request->input('activitySkills') as $skill)
      {
          Activityskill::create([
              "name" => $skill,
              "activity_id" => $id
          ]);
      }
      
      return redirect(url('/activity'));
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


        $volunteersBefore = \DB::table('users')->select('users.name as name','volunteers.*')
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

        $activityMatches = array();
        $recentMatches = array();
        $activityNoMatches = array();

        $offset = 0;

        

        $activities = \DB::table('activities')->select('activities.*','users.name as foundtion_name','foundations.image_url as      foundation_imageurl') 
                                              ->join('foundations','foundations.foundation_id','=','activities.foundation_id') 
                                              ->join('users','users.user_id','=','foundations.user_id') 
                                              ->where('activities.status',false)->get();  

        $skills = Volunteerskill::where('volunteer_id',$request->input('volunteer_id'))->get();

        for($i = 0; $i < $activities->count(); $i++){

            
                $data = null;
                $count = 0; 

                    $activityskills = Activityskill::where('activity_id',$activities[$i]->activity_id)->get();

                    $watch = Volunteeractivity::where('volunteer_id',$request->input('volunteer_id'))
                                       ->where('activity_id',$activities[$i]->activity_id)->get();

                    $activityCriteria = Activitycriteria::where('activity_id',$activities[$i]->activity_id)->get();                   

                    $volunteerCount = Volunteeractivity::where('activity_id',$activities[$i]->activity_id)->get();                   

                    if($watch->count()){
                        $data = "yes";
                    }else{
                        $data = "no";
                    }


                    $activityTempo =(object)  array("activity_id"=>$activities[$i]->activity_id,
                                            "foundation_id"=>$activities[$i]->foundation_id,
                                            "name"=>$activities[$i]->name,
                                            "image_url"=>$activities[$i]->image_url,
                                            "imageQr_url"=>$activities[$i]->imageQr_url,
                                            "description"=>$activities[$i]->description,
                                            "location"=>$activities[$i]->location,
                                            "start_time"=>$activities[$i]->start_time,
                                            "end_time"=>$activities[$i]->end_time,
                                            "group"=>$activities[$i]->group,
                                            "long"=>$activities[$i]->long,
                                            "lat"=>$activities[$i]->lat,
                                            "points_equivalent"=>$activities[$i]->points_equivalent,
                                            "status"=>$activities[$i]->status,
                                            "created_at"=>$activities[$i]->created_at,
                                            "updated_at"=>$activities[$i]->updated_at,
                                            "contactperson"=>$activities[$i]->contactperson,
                                            "contact"=>$activities[$i]->contact,
                                            "startDate"=>$activities[$i]->startDate,
                                            "foundtion_name"=>$activities[$i]->foundtion_name,
                                            "volunteerstatus"=>$data,
                                            "foundation_img" =>$activities[$i]->foundation_imageurl,
                                            "volunteer_count"=>$volunteerCount->count(),
                                            "activity_skills"=>$activityskills,
                                            "activity_criteria"=>$activityCriteria
                                            );                     


                    foreach($activityskills as $activityskill){

                            foreach($skills as $skill){

                                if(strcasecmp($skill->name , $activityskill->name)==0){
                                    
                                    $matches = $matches + 1;
                                    break;
                                        
                                }
                            }//innermost foreach

                    }//2nd foreach


                    if($matches > 0){

                      array_push($activityMatches,$activityTempo);
                      array_push($activityScores,$matches);

                    }else{

                      array_push($activityNoMatches,$activityTempo);

                    }
                
                    $count++;    
                    $matches = 0;

            
            
               
        }//for loop sa activity

          
         for($j = 0; $j < count($activityScores); $j ++) {

                for($i = 0; $i < count($activityScores)-1; $i ++){

                     if($activityScores[$i] > $activityScores[$i+1]) {

                        $temp = $activityScores[$i+1];
                        $activityScores[$i+1]=$activityScores[$i];
                        $activityScores[$i]=$temp;

                        $temp2 = $activityMatches[$i+1];
                        $activityMatches[$i+1]=$activityMatches[$i];
                        $activityMatches[$i]=$temp2;
    
                        }    
                }
                
         } 

              $reversed_array = array_reverse($activityMatches);

              usort($activityNoMatches, function($a, $b) {
                    return strtotime($a->startDate) - strtotime($b->startDate);
                });

              $reversedNoMatchhes = array_reverse($activityNoMatches);


              $activitiesToSend = array_merge($reversed_array,$reversedNoMatchhes);
              return response()->json($activitiesToSend);

        
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

        $activities = \DB::table('activities')->select('activities.*','volunteeractivities.status as joined','volunteeractivities.points as points','foundations.name as foundation_name','volunteeractivities.volunteerTimedIn as volunteerTimedIn')->join('foundations','foundations.foundation_id','=','activities.foundation_id')->join('volunteeractivities','volunteeractivities.activity_id','=','activities.activity_id')->where('volunteeractivities.volunteer_id',$request->input('volunteer_id'))->orderBy('activities.startDate','DESC')->skip($offset)->limit(5)   
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
                                            "activity_criteria"=>$activityCriteria,
                                            "volunteerTimedIn"=>$activity->volunteerTimedIn);

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
                                            "num_of_vol"=>$activity_group_id->numOfVolunteers,
                                            "type"=>$activity_group_id->type);

                             array_push($volunteersKeeper,$data);
                     }                           


                                               
        return response()->json($volunteersKeeper);                       

   }

  
   public function successAttendanceAndPointsEarned(){

   }


}