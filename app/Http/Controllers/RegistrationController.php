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



        //Hash the password
    	$request->merge(['password' => Hash::make($request->password)]);

        //create unique id for user

        //if login wtih fb, make fb_id as $user_id
        if(request('facebook_id')){
               $user_id = request('facebook_id'); 
        }
        else{ //if not login with fb, generate own unique id as user_id
    	       $user_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);
         }

        //api_token = $time + $user_id
        $time = microtime(true);
        $api_token = $user_id.$time;


      //create user's table
    	$user = User::create([
    				'user_id'=>$user_id,
    				'name'=>request('name'),
    				'email'=>request('email'),
    				'password'=>request('password'),
    				'role'=> request('role'),
    				'api_token'=> $api_token
    		]);

        //generate volunteer_id 
        $volunteer_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);


        //create volunteer's table
        $volunteer = Volunteer::create([
                        'volunteer_id' => $volunteer_id,
                         'user_id'=>$user_id,
                         'location'=>request('location'),
                         'image_url'=>request('image_url')
            ]);   

    	auth()->login($user);
        return response()->json($volunteer);


    }

    public function post(){
    	$user = User::all();

    	return response()->json($user);
    }



}
