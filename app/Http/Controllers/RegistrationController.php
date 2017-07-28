<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Volunteer;

class RegistrationController extends Controller
{
    //

    public function register(Request $request){	


                $request->merge(['password' => Hash::make($request->password)]);
                $user_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);

                $volunteer_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);

                    $time = microtime(true);
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
                         'image_url'=>$request->input('image_url')
                       ]);


                auth()->login($user);
                return response()->json($volunteer);
                   
    }

    public function post(){
    	$user = User::all();
    	return response()->json($user);
    }
    
    public function addphoto(){

    }


}
