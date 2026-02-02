<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AuthCheck
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('user_id')) {
            return redirect('/login');
        }

        return $next($request);
    }
}
