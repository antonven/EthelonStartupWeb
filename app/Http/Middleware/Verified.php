<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Verified
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
        //check if auth user is verified in the db
        if(Auth::user()->verified == 1)
        {
            return $next($request);
        }
        else 
        {
            Auth::logout();
            return redirect(url('/login'))->with('notVerified', 'you are not verified');
        }
    }
}
