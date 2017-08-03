<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Volunteerskill;
use App\Activity;
use App\Volunteerbeforeactivity;
use App\Volunteerafteractivity;
use App\Http\Controllers\DB;
use App\Volunteeractivity;



class VolunteerController extends Controller
{
    //

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

          }else{
            return "wtf";
          }

        return "Success";
    }

    //join activity nga wala pa nahitabo
    public function joinActivity(Request $request){

    	Volunteerbeforeactivity::create([

    		 'volunteer_id'=>$request->input('volunteer_id'),
    		 'activity_id'=>$request->input('activity_id'),
    		 
    		]);


        Volunteeractivity::create([
             'volunteer_id'=>$request->input('volunteer_id'),
             'activity_id'=>$request->input('activity_id'),
             'status'=> false  
            ]);


    }

    public function successAttendance(Request $request){

    	Volunteerafteractivity::create([

    		'volunteer_id'=>$request->input('volunteer_id'),
    		 'activity_id'=>$request->input('activity_id')

    		]);

         \DB::table('volunteeractivities')
            ->where('volunteer_id',$request->input('volunteer_id'))
            ->where('activity_id',$request->input('activity_id'))
            ->update(['status' => true]);

    }

    //kuhaon ang activities nga wala pah na attendan sa volunteer* 
    public function getBeforeActivities(Request $request){

    	$volunteer_id = $request->input('volunteer_id');

    	//return dd($volunteer_id);
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

}
