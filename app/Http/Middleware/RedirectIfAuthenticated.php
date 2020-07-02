<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            return redirect(RouteServiceProvider::HOME);
        }

        if ($guard == "admin" && Auth::guard($guard)->check()) {
            return redirect('/admin/admindashboard');
        }
        if ($guard == "staff" && Auth::guard($guard)->check()) {
            return redirect('/staff/staffdashboard');
        }
        if ($guard == "auditor" && Auth::guard($guard)->check()) {
            return redirect('/auditor/dashboard');
        }
        if ($guard == "registrar" && Auth::guard($guard)->check()) {
            return redirect('/registrar/dashboard');
        }
        if ($guard == "dean" && Auth::guard($guard)->check()) {
            return redirect('/dean/dashboard');
        }

        return $next($request);
    }
}
