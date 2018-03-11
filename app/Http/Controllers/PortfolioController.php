<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\Template;

class PortfolioController extends Controller
{
    public function __contruct()
    {

    }

    public function index()
    {
        $templates = \Auth::user()->foundation->portfolio->templates;
    	return view('portfolio.index', compact('templates'));
    }

    public function setPortfolioSetting($id, Request $request)
    {
        if($request->input('setting') == 1)
        {
            Portfolio::where('id', \Auth::user()->foundation->portfolio->id)
                ->update([
                    'portfolioType' => 1
                ]);
            $templates = \Auth::user()->foundation->portfolio->templates;
            return response()->json($templates);
        }
        else
        {
           Portfolio::where('id', \Auth::user()->foundation->portfolio->id)
                ->update([
                    'portfolioType' => 0
                ]);
        }
    }
}
