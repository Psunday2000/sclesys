<?php
// App\Http\Middleware\RoleMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        // Check if the authenticated user has the specified role
        if (Auth::check() && Auth::user()->role->name === $role) {
            return $next($request);
        }

        // Redirect or handle unauthorized access
        return redirect('/')->with('error', 'Unauthorized.');
    }
}
