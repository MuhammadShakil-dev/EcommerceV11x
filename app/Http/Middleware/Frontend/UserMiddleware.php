<?php

namespace App\Http\Middleware\Frontend;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class UserMiddleware
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
}
