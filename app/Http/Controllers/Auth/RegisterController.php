<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        
        $user_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);
        $time = microtime(true);
        $api_token = $user_id.$time;
        $foundation_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);

        //Dapat inig register sa foundation naa iyang mga description, foundation name, website url, facebook url. 
        Foundation::create([
           'foundation_id'=> $foundation_id,
            'name' => $time.'wala pa',
            'user_id'=>$user_id,
            'image_url'=>'',
            'description'=>'',
            'location'=>'',
            'email'=> $data['email']                                                
            ]);

        return User::create([

            'user_id' => $user_id,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'admin',
            'api_token' => $api_token
            
        ]);
    }
}
