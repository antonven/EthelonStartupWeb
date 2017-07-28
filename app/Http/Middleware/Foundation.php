<?php

namespace App\Http\Middleware;

use Closure;

class Foundation
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
         if(\Auth::user()->role == "foundation"){
            return $next($request);
        }else {
            $error = ['You are not a Foundation fuck you'];
            return response()->json($error);
        }
        
    }
}
