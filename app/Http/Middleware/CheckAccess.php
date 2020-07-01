<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAccess
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role == 2 or Auth::user()->role == 4) {
            return $next($request);
        }

        return abort(403);
    }
}
