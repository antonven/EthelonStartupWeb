<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Notification_user;

use Illuminate\Http\Request;
use App\Groupnotification;
use App\Activity;
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


  public function getNofitications(Request $request){

    $user = $request->input('volunteer_id');

    $notifications = \DB::table('notifications')->select('notifications.*','notification_users.*','notifications.id as notificationID','notification_users.id as notification_user_id')
                                                ->join('notification_users','notification_users.notification_id','=','notifications.id')
                                                ->where('notification_users.receiver_id',$user)->orderBy('notification_users.date','asc')->get();

          $notificationObject = array();                                      

    foreach($notifications as $notification){


       if($notification->major_type == 'activity_group' ){
          
         $image = Activity::select('image_url')->where('activity_id',$notification->sender_id)->first();
         $timeNowz = \Carbon\Carbon::now()->format('Y-m-d h:i');

         $timeNow = \Carbon\Carbon::parse($timeNowz)->format('Y-m-d H:i');  
         $timeNow = \Carbon\Carbon::parse($timeNow);
         $notDate = \Carbon\Carbon::parse($notification->date)->format('Y-m-d H:i');   
         $notDate = \Carbon\Carbon::parse($notDate);

         $hours = \Carbon\Carbon::parse($notification->created_at)->diffForHumans();

         $data = array("notification_id"=>$notification->notificationID,
                        "notification_user_id"=>$notification->notification_user_id,
                        "body"=>$notification->body,
                            "isRead"=>$notification->isRead,
                            "major_type"=>$notification->major_type,
                            "data"=>$notification->data,
                            'image_url'=>$image->image_url,
                            'sender_id'=>$notification->sender_id,
                            'hours'=>$hours);

         
          array_push($notificationObject,$data);
       }

    }               

    return response()->json($notificationObject);                         

  }

  public function notificationTabClicked(Request $request){

    $user = $request->input('volunteer_id');

      $notifications = \DB::table('notifications')->select('notifications.*','notification_users.*','notifications.id as notificationID','notification_users.id as notification_user_id')
                                                ->join('notification_users','notification_users.notification_id','=','notifications.id')
                                                ->where('notification_users.receiver_id',$user)->update(['isRead'=>true]);



  }

  public function numOfUnread(Request $request){

    $user = $request->input('volunteer_id');
    $numOfUnread = 0;

    $notifications = \DB::table('notifications')->select('notifications.*','notification_users.*','notifications.id as notificationID','notification_users.id as notification_user_id')
                                                ->join('notification_users','notification_users.notification_id','=','notifications.id')
                                                ->where('notification_users.receiver_id',$user)->orderBy('notification_users.date','asc')->get();

                                      
    foreach($notifications as $notification){

         if($notification->isRead == false){
            $numOfUnread++;
          }

    } 

    $data = array("number"=>$numOfUnread);

    return response()->json($data);

  }


}
