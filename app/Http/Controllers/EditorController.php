<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;
use App\upload;

class EditorController extends Controller
{
    public function index($template_name)
    {
        //get template
    	$template = Template::all()->where("template_name", $template_name)->where("portfolio_id", \Auth::user()->foundation->portfolio->id)->first();
        $template_id = $template->id;
        //get all assets
        $assets = Upload::all()->where('template_id', $template->id);

    	return view('editor.index', compact('template','template_id','assets'));
    }

    public function upload(Request $request, $template_id)
    {
        //get file
        $file = $request->file('files')[0];
        $extension = $file->clientExtension();
        $destinationPath = public_path('file_attachments');
        //check if file not not executable
        if($extension != "bin")
        {
            $destinationPath = public_path('file_attachments');
            $filename = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$file->getClientOriginalName();
            
            $file->move($destinationPath, $filename);
            
            // \Cloudder::upload(url('/file_attachments').'/'.$filename);
              
            // $url = \Cloudder::getResult();
            
            // if($url){

            //    return $url['url'];

            // }
            Upload::create([
                "template_id" => $template_id,
                "image_name" => url('/file_attachments').'/'.$filename
            ]);

            $j_file = array(
                'data' => array(
                    'src' => url('/file_attachments').'/'.$filename,
                    'type' => 'image',
                    'width' => '150',
                    'height' => '150',
                )
            );
            echo json_encode($j_file);
        }
    }

    public function store(Request $request, $template_id)
    {
        Template::where('id', $template_id)
            ->update([
                'html' => $request->input('gjs-html'),
                'css' => $request->input('gjs-css'),
                'components' => $request->input('gjs-components'),
                'styles' => $request->input('gjs-styles'),
                'assets' => $request->input('gjs-assets')
            ]);
    }

    public function load(Request $request, $template_id)
    {
        return var_dump($request);
    }
}
