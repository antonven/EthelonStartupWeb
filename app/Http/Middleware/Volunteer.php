<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class Volunteer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // return dd(\Auth::user());

        if(\Auth::user()->role() == "volunteer"){
            return $next($request);
        }else {
            $error = ['You are not a Volunteer fuck you'];
            return response()->json($error);
        }
        
    }
}
