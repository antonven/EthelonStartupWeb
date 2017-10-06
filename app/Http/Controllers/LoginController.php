<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Volunteer;
use App\User;

class LoginController extends Controller
{
    //
    // $found = App\Foundation::where('foundation_id', 'qwe')->with('activities')->get();

    public function login(Request $request){

    

    	if(!\Auth::attempt(request(['email','password']))){
            
            $message = array("message"=>"Invalid credentials");
    		

    	}else{
            
                    $user = User::where('email',$request->input('email'))->first();
                    $volunteer = Volunteer::where('user_id',$user->user_id)->first();
                    $message = "Success";

                                       // return response()->json($user->user_id);

                return response()->json(array("volunteer_id"=>$volunteer->volunteer_id, 
                                            "api_token"  => $user->api_token,
                                            "message" => $message,
                                            "name"=> $user->name,
                                            "image_url" => $volunteer->image_url));            
    	   	       
    	}
    }

 
   public function logout(Request $request){
    
        Volunteer::where('volunteer_id',$request->input('volunteer_id'))->update([
                    "fcm_token"=> null
            ]);

   }
    

    public function loginwithFb(Request $request){

            $watcher = User::where('user_id',$request->input('facebook_id'))->get();

            if($watcher->count()){

                $emailWatcher = User::where('email',$request->input('email'))->get();

                Volunteer::where('user_id',$request->input('facebook_id'))
                                    ->update([
                                        "fcm_token" => $request->input('fcm_token')    
                                        ]);

                $watch = Volunteer::where('user_id',$request->input('facebook_id'))->first();                    
                $watcher = User::where('user_id',$request->input('facebook_id'))->first();
                    
                  $data = array("message"=>"Not First Time","volunteer_id"=>$watch->volunteer_id,"api_token"=>$watcher->api_token);      
                     
                  return response()->json($data);

              }

            else{

                $emailWatcher = User::where('email',$request->input('email'))->get();

                if($emailWatcher->count()){

                    $data = array("message"=>"Email already exists");
                    return response()->json($data);

                }else{

                   $user_id = $request->input('facebook_id'); 
                   $email = $request->input('email');
                   $role = $request->input('role');
                   $name = $request->input('name');
                   
                    $volunteer_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);
                    $time = microtime(true);
                    $api_token = $user_id.$time;

                    $user = User::create([
                            'user_id'=>$user_id,
                            'name'=>$name,
                            'email'=>$email,
                            'role'=> $role,
                            'api_token'=> $api_token
                        ]);

                    $volunteer = Volunteer::create([
                            'volunteer_id' => $volunteer_id,
                             'user_id'=>$user_id,
                             'location'=>$request->input('location'),
                             'image_url'=>$request->input('image_url'),
                             'fcm_token'=>$request->input('fcm_token')
                     ]);
                                        
                    
                     $data = array("message"=>"First Time","volunteer_id"=>$volunteer_id,"api_token"=>$api_token);    
                     
                     //return $data;
                     return response()->json($data);
                 }
             }

    }

    
    public function sessionwatch(Request $request){

        
            $volunteer = Volunteer::where('user_id',$request->input('facebook_id'))->first();
                          
            // return dd($volunteer);          
            return $volunteer->volunteer_id;
                
    }

}
