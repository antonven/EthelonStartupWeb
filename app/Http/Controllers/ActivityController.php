<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Volunteerbeforeactivity;
use App\Volunteerafteractivity;
use App\Activity;
use app\Volunteeractivity;
use App\Volunteerskill;
use App\Activityskill;
use App\User;


class ActivityController extends Controller
{
    
    public function index()
    {
        $activities = \Auth::user()->foundation->activities;
        return view('activity.activityIndex', compact('activities'));
    }
    public function create()
    {
        return view('activity.activityCreate');
    }
    public function store(Request $request)
    {
        $file = $this->uploadFile($request->file('file'));
        $activityId = Activity::create([
            "activity_id" => substr(sha1(mt_rand().microtime()), mt_rand(0,35),7),
            "foundation_id" => \Auth::user()->foundation->foundation_id,
            "name" => $request->input('activityName'),
            "image_url" => $file,
            "imageQr_url" => $request->input('activityName'),
            "description" => $request->input('activityDescription'),
            "location" => "",
            "start_time" => "",
            "end_time" => "",
            "date" => "",
            "group" => "",
            "long" => 1,
            "lat" => 2,
            "points_equivalent" => 1,
            "status" => 1
        ])->activity_id;
        
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
        if($extension != "bin")
        {
            $destinationPath = public_path('file_attachments');
            $filename = $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            
            return $filename;
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

    	$volunteersBefore = Volunteerbeforeactivity::where('activity_id',$activity_id)->get();
    	return response()->json($volunteersBefore);
        
    }

    //get volunteers that joined and captured the qr code
    public function getVolunteersAfter(Request $request){
    	$activity_id = $request->input('activity_id');

    	$volunteersAfter = Volunteerafteractivity::where('activity_id',$activity_id)->get();
    	return response()->json($volunteersAfter);
    }

    //get activities nga not done
    public function getActivitiesNotDone(Request $request){
        $matches = 0;
        $activityKeeper = array();
        $activityScores = array();
        $newActivities = array();

    	$activities = Activity::where('status',false)->get();
        $skills = Volunteerskill::where('volunteer_id',$request->input('volunteer_id'))->get();

            foreach($activities as $activity){
                $count = 0;
                    $activityskills = Activityskill::where('activity_id',$activity->activity_id)->get();


                    foreach($activityskills as $activityskill){

                            foreach($skills as $skill){

                                if($skill->name == $activityskill->name){
                                    $matches = $matches + 1;
                                    break; 
                                }
                            }//innermost foreach

                   
                    }//2nd foreach
                
                    
                    array_push($activityKeeper,$activity);
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
            
            return response()->json(array_reverse($activityKeeper));

    	//return response()->json($activities);
        
    }

    public function portfolio(Request $request){

        $activities = \DB::table('activities')->select('activities.*','volunteeractivities.status as joined')->join('volunteeractivities','volunteeractivities.activity_id','=','activities.activity_id')->where('volunteeractivities.volunteer_id',$request->input('volunteer_id'))->orderBy('activities.created_at','DESC')->get();


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
   
}
