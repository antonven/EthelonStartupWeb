<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    //

    public function register(Request $request){	

    	$request->merge(['password' => Hash::make($request->password)]);
    	$user_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);

    	$user = User::create([
    				'user_id'=>'fuck',
    				'name'=>request('name'),
    				'email'=>request('email'),
    				'password'=>request('password'),
    				'role'=> 'volunteer',
    				'api_token'=> 'tempolangsa'
    		]);		

    	auth()->login($user);
    }

    public function post(){
    	$user = User::all();

    	return response()->json($user);
    }
}
