<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Foundation;
use App\User;
use App\Volunteer;

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
                //get all activities of foundation
                $activities = \Auth::user()->foundation->activities;
                $finished_activities = false;

                foreach($activities as $activity)
                {
                    if($activity->status == 1)
                    {
                        $finished_activities = true;
                    }
                }

                //get all activity id
                $activity_ids = $this->getActivityIds($activities);

                $volunteersCount = \DB::table('volunteeractivities')->whereIn('activity_id', $activity_ids)->count();
            }
            else
            {
                $activities = null;
            }
            return view('dashboard.dashboardIndex', compact('activities','finished_activities','volunteersCount'));
        }
        else
        {

        }

    }
    public function getActivityIds($activities)
    {
        //returns all ids
        $activity_ids = array();
        foreach($activities as $activity)
        {
            array_push($activity_ids, $activity->activity_id);
        }

        return $activity_ids;
    }
    public function test()
    {
        return view('dashboard.test');
    }
}
