<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        if (Auth::guard($guard)->check() && $guard=='admin' ) {
            return redirect()->route('admin.dashboard');
        }
        if (Auth::guard($guard)->check() && $guard=='driver') {
            return redirect()->route('driver.dashboard');
        }
        return $next($request);
    }
}
