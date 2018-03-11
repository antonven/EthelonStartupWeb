<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($foundation_id)
    {
    	return view('profile.index');
    }
}
