<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboardIndex');
    }
    public function test()
    {
        return view('dashboard.test');
    }
}
