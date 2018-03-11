<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;
class TemplateController extends Controller
{
    public function store(Request $request)
    {
    	$this->validate($request,
    		[
    			'templateName' => "required|string"
    		]);

    	Template::create([
    		'portfolio_id' => \Auth::user()->foundation->portfolio->id,
    		'template_name' => $request->input('templateName')
    	]);

        return redirect(url('/portfolio'.'/'.\Auth::user()->foundation->foundation_id));
    }

    public function checkTemplate(Request $request)
    {
        $validator = $this->validate($request,
            [
                'templateName' => "required|string"
            ]);

        return response()->json("true");
    }

    public function activateTemplate($template_id)
    {
        if(\Auth::user()->foundation->portfolio->templates->where('active', 1)->count())
        {
            $temp = \Auth::user()->foundation->portfolio->templates->where('active', 1)->first();
            Template::where('id', $temp->id)
                ->update([
                    "active" => 0
                ]);
            Template::where('id', $template_id)
                ->update([
                    "active" => 1
                ]);
            return redirect(url('/portfolio'.'/'.\Auth::user()->foundation->foundation_id));
        }
        else
        {
            Template::where('id', $template_id)
                ->update([
                    "active" => 1
                ]);
            return redirect(url('/portfolio'.'/'.\Auth::user()->foundation->foundation_id));
        }
    }
}
