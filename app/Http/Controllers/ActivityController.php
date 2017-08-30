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

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\App;

class ActivityController extends Controller
{


 public function deleteall(){
    \DB::table('users')->delete();
    \DB::table('foundations')->delete();
    \DB::table('volunteers')->delete();
    \DB::table('activityskills')->delete();
    \DB::table('volunteergroups')->delete();
    \DB::table('volunteerbeforeactivities')->delete();
    \DB::table('volunteerafteractivities')->delete();
    \DB::table('activitycriterias')->delete();
    \DB::table('volunteerskills')->delete();
    \DB::table('volunteeractivities')->delete();

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

  
  public function test(Request $request){
   
   $activities = Activity::where('activity_id','df89c1e')->get();

      foreach($activities as $activity){

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
                    
            }

    
    $groups = Activitygroup::all();
    return response()->json($groups);


  }
    
    public function index()
    {
        if(\Auth::user()->foundation)
        {
            $activities = \Auth::user()->foundation->activities;
        }
        else{
            $activities = null;
        }

        return view('activity.activityIndex', compact('activities'));
    }
    
    public function create()
    {
        return view('activity.activityCreate');
    }

    public function store(Request $request)
    {
        $dt = new \DateTime($request->input('startDate'));
        $sd = Carbon::instance($dt);
        $url = $this->uploadFile($request->file('file'));
        $activity_id_store = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);
        //$qrUrl = $this->uploadQr($activity_id_store);

        $qrCode = new QrCode($activity_id);

         $qrCode
            ->setWriterByName('png')
            ->setMargin(10)
            ->setEncoding('UTF-8')
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH)
                ->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0])
                ->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255])
                ->setValidateResult(false);   
                
        $qrUrl = base64_encode($qrCode->writeString());    

        $activityId = Activity::create([
            "activity_id" => $activity_id_store, 
            "foundation_id" => \Auth::user()->foundation->foundation_id,
            "name" => $request->input('activityName'),
            "image_url" => $url,
            "imageQr_url" => $qrUrl,
            "description" => $request->input('activityDescription'),
            "location" => "ambot asa",
            "group" => "1",
            "long" => $request->input('long'),
            "lat" => $request->input('lat'),
            "points_equivalent" => 1,
            "status" => 0,
            "startDate" => $sd->toDateTimeString()
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
        if($extension != "bin")
        {

            $destinationPath = public_path('file_attachments');
            $filename = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$file->getClientOriginalName();

            $file->move($destinationPath, $filename);

            $file_decoded = json_decode($file);
            //return dd($file);


            \Cloudder::upload(url('/file_attachments').'/'.$filename);

            $url = \Cloudder::getResult();
            //return dd($url);

            if($url){

                return $url['url'];

            }
            
        }
        else
        {
            $files = "";
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

    //

	//get volunteers that said they will join
    public function getVolunteersBefore(Request $request){

    	$activity_id = $request->input('activity_id');


        $volunteersBefore = \DB::table('users')->select('users.name as name','volunteers.image_url as image_url')
                                           ->join('volunteers','volunteers.user_id','=','users.user_id')
                                           ->join('volunteerbeforeactivities','volunteerbeforeactivities.volunteer_id','=','volunteers.volunteer_id') 
                                           ->where('volunteerbeforeactivities.activity_id',$activity_id)
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
        

                
    	$activities = Activity::where('status',false)->get();
        $activities = \DB::table('activities')->select('activities.*','foundations.name as foundtion_name') 
                                              ->join('foundations','foundations.foundation_id','=','activities.foundation_id') 
                                               ->where('activities.status',false)->get();    

        $skills = Volunteerskill::where('volunteer_id',$request->input('volunteer_id'))->get();


            foreach($activities as $activity){
                $count = 0; 

               
                    $activityskills = Activityskill::where('activity_id',$activity->activity_id)->get();

                    $watch = Volunteerbeforeactivity::where('volunteer_id',$request->input('volunteer_id'))
                                       ->where('activity_id',$activity->activity_id)->get();
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
                                            "volunteerstatus"=>$data);                     

                    /*$act = \DB::table('activities')->select('activities.*','volunteeractivities.volunteer_id as vol_count')
                                                   ->join('volunteeractivities','volunteeractivities.activity_id','=','activities.activity_id')->where('activities.activity_id',$activity->activity_id)->get();*/
                                                                //problem here    
                                                  // return response()->json($act); 
                                 
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


        $activities = \DB::table('activities')->select('activities.*','volunteeractivities.status as joined','foundations.name as foundation_name')->join('foundations','foundations.foundation_id','=','activities.foundation_id')->join('volunteeractivities','volunteeractivities.activity_id','=','activities.activity_id')->where('volunteeractivities.volunteer_id',$request->input('volunteer_id'))->orderBy('activities.created_at','DESC')
                ->get();


        return response()->json($activities);

           
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

       /* $volunteersToRate = \DB::table('activitygroups')->select('users.name','activitygroups.id','volunteegroups.volunteer_id','activitygroups.numOfVolunteers')->join('volunteergroups','volunteergroups.activity_groups_id','=','activitygroups.id')->join('volunteers','volunteers.volunteer_id','=','volunteergroups.volunteer_id')->join('users','users.user_id','=','volunteers.user_id')->where('activitygroups.activity_id',$request->input('activity_id'))get();*/
       
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

   public function rategroupmate(Request $request){
    
        $activity_group_id = $request->input('activitygroups_id');
        $volunteer_id = $request->input('volunteer_id');
        $activity_id = $request->input('activity_id');
        $criteria_name = $request->input('criteria_name');
        $rating = $request->input('rating');

        $mate = Volunteercriteria::create([
                    'volunteer_id' => $volunteer_id,
                    'name'=> $criteria_name,
                    'actvity_id'=>$activity_id,
                    'activitygroups_id'=>$activity_group_id,
                    'sum_of_rating' => $rating,          
                    'criteria_name' => $criteria_name     
            ]);

            if($mate){

                    $volunteercriteriapoints = Volunteercriteriapoint::where('activity_id',$activity_id)
                                                         ->where('volunteer_id',$volunteer_id)
                                                         ->where('criteria_name',$criteria_name)->first();
                       if($volunteercriteriapoints){

                                $total_points = $volunteercriteriapoints->total_points + $rating;   
                                $num_of_raters = $volunteercriteriapoints->no_of_raters + 1;
                                $average_points = $total_points / $num_of_raters;   

                                    $volunteercriteriapoints = \DB::table('volunteercriteriapoints')->where('activity_id',$activity_id)->where('volunteer_id',$volunteer_id)
                                                         ->where('criteria_name',$criteria_name)
                                                         ->update(['total_points'=>$total_points,
                                                                   'no_of_raters'=>$num_of_raters,
                                                                   'average_points'=>$average_points]);
                                    if($volunteercriteriapoints){

                                        $data = array("message"=>"Success");

                                        return response()->json($data);

                                    }else{
                                         $data = array("message"=>"Something's wrong");

                                         return response()->json($data);
                                    }                     

                            }else{

                                $data = array("message"=>"Something's wrong");

                                return response()->json($data);
                            }                             

             }else{

                $data = array("message"=>"Something's wrong");

                return reponse()->json($data);
             }

   }


}
