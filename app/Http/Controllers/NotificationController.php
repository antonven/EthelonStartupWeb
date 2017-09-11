<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Groupnotification;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Volunteer;

class NotificationController extends Controller
{
    //
	public function groupsController(Request $request){


        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        $optionBuilder->setPriority('high');


		$notifications = Groupnotification::where('volunteer_id',$request->input('volunteer_id'))->get();
		$volunteer = Volunteer::where('volunteer_id',$request->input('volunteer_id'))->first();


		if($notifications->count()){

		  foreach($notifications as $notification){

			if($volunteer->fcm_token != null){

                $activity_group_id = \DB::table('activitygroups')->select('activitygroups.*')
                                                        ->join('volunteergroups','volunteergroups.activity_groups_id','=','activitygroups.id')
                                                        ->where('volunteergroups.volunteer_id',$volunter->volunteer_id)
                                                        ->where('activitygroups.activity_id',$notification->activity_id)
                                                        ->first();

                $volunteersToRate = \DB::table('users')->select('users.name','volunteers.volunteer_id','volunteers.image_url')
                                                ->join('volunteers','volunteers.user_id','=','users.user_id')
                                                ->join('volunteergroups','volunteergroups.volunteer_id','=','volunteers.volunteer_id')
                                                ->where('volunteergroups.activity_groups_id',$activity_group_id->id)
                                                ->where('volunteergroups.volunteer_id','!=',$volunter->volunteer_id)
                                                ->get();   


                     foreach($volunteersToRate as $volunteerToRate){

                             $data = array("name"=>$volunteerToRate->name,
                                            "volunteer_id"=>$volunteerToRate->volunteer_id,
                                            "image_url"=>$volunteerToRate->image_url,
                                            "activity_group_id"=>$activity_group_id->id,
                                            "num_of_vol"=>$activity_group_id->numOfVolunteers);

                             array_push($volunteersKeeper,$data);
                     }                           


                     	  $activity = Activity::where('activity_id',$notification->activity_id)->first();

                          $notificationBuilder = new PayloadNotificationBuilder('Ethelon');
                          $notificationBuilder->setBody('Your groupmates for ' + $activity->name + ' has been revealed')
                                              ->setSound('default'); 

                            $dataBuilder = new PayloadDataBuilder();
                            $dataBuilder->addData([
                                'activity'=>$activity,
                                'volunteersToRate'=>$volunteersKeeper
                                ]);

                             $option = $optionBuilder->build();
                             $notification = $notificationBuilder->build();
                             $data = $dataBuilder->build();
                             
                            $token = $volunter->token;
                            $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

                            if($downstreamResponse->numberSuccess() > 0){

                            	$delete = Groupnotification::where('activity_id',$activity->activity_id)
                            					 ->where('volunteer_id',$volunteer_id)
                            					 ->delete(); 

                            }
                            
				 }
			 }	
			 
			 $data = array("message"=>"good");

			return response()->json($data);
		}
		else{
			$data = array("message"=>"good");

			return response()->json($data);
		}
	}

}
