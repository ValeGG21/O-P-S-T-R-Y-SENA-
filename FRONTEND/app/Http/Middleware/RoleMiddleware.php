<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!in_array(auth()->user()->rol, explode('|', $role))) {
            return redirect()->route('login')->withErrors('No tienes permisos para acceder a esta sección.');
        }

        return $next($request);
    }
}
