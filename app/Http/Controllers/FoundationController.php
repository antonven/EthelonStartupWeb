<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activitiyskill;
use App\Activity;
use App\Foundation;
use App\User;
use App\Setting;

class FoundationController extends Controller
{
    //

    public function getFoundationActivities(Request $request){
        $activities = Activity::where('foundation_id',$request->input('foundation_id'))->get();

        return response()->json($activities);
    }

    public function getallfoundations(){
		$foundations = Foundation::all();

		 return response()->json($foundations);
    }

    public function foundationList()
	{
		$foundations = Foundation::all();

		return view('foundation.foundationList', compact('foundations'));
	}

	public function verifyFoundation($id)
	{
		User::where('user_id', $id)
			->update([
					"verified" => 1
				]);

		return redirect(url('/admin/foundationlist'));
	}

	public function configurations()
	{
		$settings = Setting::all()->first();

		return view('foundation.configuration', compact('settings'));
	}

	public function updateSetting($setting,$value)
	{
		Setting::where('id', '1')->update([
			$setting => $value
		]);

		return response()->json("Ji");
	}
}
