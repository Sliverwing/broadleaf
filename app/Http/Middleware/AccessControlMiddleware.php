<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class AccessControlMiddleware
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
        $name = Route::currentRouteName();
        if (Auth::check() && Auth::user()->can($name))
        {
            return $next($request);
        }
        else
        {
            return abort(403);
        }
    }
}
