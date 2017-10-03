<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
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
    public function test()
    {
        return view('dashboard.test');
    }
}
