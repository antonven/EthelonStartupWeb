<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Volunteer;
use App\Volunteerbadge;

class RegistrationController extends Controller
{
    
    //
    
    public function register(Request $request){	

        $watch = User::where('email',$request->input('email'))->get();
        if($watch->count()){

                $data  = array("message"=>"email already exists");

                return response()->json($data);
        }else{

                $request->merge(['password' => Hash::make($request->password)]);
                //$user_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);

                $volunteer_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);

                    $time = microtime(true);
                     
                     $user_id = mt_rand().$time;  
                     $api_token = $user_id.$time;

                     $user = User::create([
                        'user_id'=>$user_id,
                        'name'=>$request->input('name'),
                        'email'=>$request->input('email'),
                        'password'=>$request->input('password'),
                        'role'=> $request->input('role'),
                        'api_token'=> $api_token
                    ]);

                       $volunteer = Volunteer::create([
                        'volunteer_id' => $volunteer_id,
                         'user_id'=>$user_id,
                         'location'=>$request->input('location'),
                         'image_url'=>$request->input('image_url'),
                         'fcm_token'=>$request->input('fcm_token')
                       ]);

                       $skills = array('Environment','Education','Sports','Arts','Medical','Culinary','Livelihood','Charity');

                    foreach($skills as $skill){
                             $sd = Volunteerbadge::create([
                                      'badge'=>'Nothing',
                                      'volunteer_id'=>$volunteer_id,
                                      'gaugeExp'=>0,
                                      'star'=>0,
                                      'skill'=>$skill,
                                      'points'=>0
                              ]);
                    }

                       $data = array("api_token"=>$api_token,"volunteer_id" => $volunteer_id,"name"=>$request->input('name'),"message"=>"success");

                //auth()->login($user);
                return response()->json($data);
            }
                   
    }

    public function post(){
    	$user = User::all();
    	return response()->json($user);
    }
    
    public function addphoto(){

    }



}
