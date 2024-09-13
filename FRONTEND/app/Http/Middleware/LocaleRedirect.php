<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LocaleRedirect
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->segment(1);

        if (!in_array($locale, ['es', 'en'])) { // Add your supported locales here
            $locale = 'es'; // Default locale
        }

        app()->setLocale($locale);

        return $next($request);
    }
}