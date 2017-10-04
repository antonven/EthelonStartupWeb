<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Foundation;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        if(\Auth::user()->role == "admin")
        {
            $foundations = User::all();
            return view('dashboard.adminDashboardIndex', compact('foundations'));
        }
        else if(\Auth::user()->role == "foundation")
        {
            if(\Auth::user()->foundation)
            {
                $activities = \Auth::user()->foundation->activities;
            }
            else
            {
                $activities = null;
            }
            return view('dashboard.dashboardIndex', compact('activities'));
        }
        else
        {

        }

    }
    public function test()
    {
        return view('dashboard.test');
    }
}
