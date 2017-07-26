<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Volunteer;

class LoginController extends Controller
{
    //
    // $found = App\Foundation::where('foundation_id', 'qwe')->with('activities')->get();

    public function login(Request $request){
    	if(!\Auth::attempt(request(['email','password']))){
            $error = ['Please log in the proper credentials'];
    		return response()->json($error);
    	}else{
            if(\Auth::user()->role == 'volunteer'){
                $volunteer = Volunteer::where('user_id',\Auth::user()->user_id)->get();
                return response()->json($volunteer);
            }else{
                // wa lang sa tay mobile ang foundation
            }
            
    		//return response()->json(\Auth::user()->api_token);	    	
    	}
    }
}
