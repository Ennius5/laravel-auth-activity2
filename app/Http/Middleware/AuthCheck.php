<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Auth;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next)
    // {
    // if(!Session::has('user_id')){
    //     return redirect('/login');
    //     // return $next($request);
    // }
    // return $next($request);
    // }
    public function handle(Request $request, Closure $next)
    {
        // Use Laravel's authentication check
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        return $next($request);
    }
}


