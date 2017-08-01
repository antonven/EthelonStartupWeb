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
            
            $message = array("Message"=>"Invalid credentials");
    		return response()->json($message);
            
    	}else{
            
            if(\Auth::user()->role == 'volunteer'){
                
                $volunteer = Volunteer::where('user_id',\Auth::user()->user_id)->get();
                return response()->json($volunteer->volunteer_id); 
                
            }else{
                // wa lang sa tay mobile ang foundation
            }
            
    		//return response()->json(\Auth::user()->api_token);	    	
    	}
    }

    public function loginwithFb(Request $request){

            $watcher = User::where('user_id',$request->input('facebook_id'))->get();
                        
            if(count($watcher)!=0){

                    auth()->login($request->input('facebook_id'));

                     $message = array("Message"=>"logged in");
                     return response()->json($message);
                     

            }else{

            if($request->input('facebook_id') && $request->input('email') && $request->input('role') && $request->input('name')){


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
                         'image_url'=>$request->input('image_url')
                 ]);
                                    

                 auth()->login($user);
                    
                 $message = "First Time";
                 return $message;
                 //return response()->json(\Auth::user()->role);
             }
             }

    }

    
    public function sessionwatch(Request $request){

            //auth()->login($request->input('facebook_id'));
            $volunteer = Volunteer::where('user_id',$request->input('facebook_id'))->first();
          //   $volunteer = Volunteer::first();   
                //return dd($volunteer);
            return $volunteer->volunteer_id;
                
    }

}
