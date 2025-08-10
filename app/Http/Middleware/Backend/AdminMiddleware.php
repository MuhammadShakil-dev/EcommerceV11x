<?php

namespace App\Http\Middleware\Backend;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!empty(Auth::check())) 
        { 

            if (Auth::user()->is_admin == 1) 
            {
                return $next($request);

            }
            else
            {
                Auth::logout();
                // return redirect(url(''));
                // return redirect()->route('customAuths.login');
                return redirect('customAuths/login');
            }
            
        }
        else
        {
            Auth::logout();
            // return redirect(url(''));
            // return redirect()->route('customAuths.login');
            return redirect('customAuths/login');
        }
    }
}
