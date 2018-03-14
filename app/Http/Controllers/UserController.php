<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Activityskill;
use App\Foundation;
use App\User;

class UserController extends Controller
{
    public function index()
    {
    	return view('user.userIndex');
    }
    public function lists($skill)
    {
    	$activities = Activity::whereHas('skills', function($query) use($skill)
        {
            $query->where('name', $skill);
        })->orderBy('created_at', 'DESC')->get();

        return view('user.userActivityListIndex', compact('activities','skill'));
    }
    public function activityView($id)
    {
        $activity = Activity::find($id);

        return view('user.userActivityView', compact('activity'));
    }
    public function foundationList()
    {
        $foundations = Foundation::all();

        return view('user.userFoundationsList', compact('foundations'));
    }
    public function portfolioView($foundation_name)
    {
        $user = User::all()->where('name', $foundation_name)->first();
        $template = $user->foundation->portfolio->templates->where("active", 1)->first();

        return view('user.userFoundationPortfolioView', compact('template','user'));
    }
    public function viewFoundation($foundation_name)
    {
        $user = User::all()->where('name', $foundation_name)->first();

        return view('user.userViewFoundation', compact('user'));
    }
}
