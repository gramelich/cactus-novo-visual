<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SetDefaultLanguage
{
    public function handle(Request $request, Closure $next): Response
    {
        $language = null;

        if (Auth::check() && Auth::user()->language) {
            // Guard padrão web
            $language = Auth::user()->language;
        } elseif (Auth::guard('api')->check() && Auth::guard('api')->user()->language) {
            // Guard api
            $language = Auth::guard('api')->user()->language;
        }

        if ($language) {
            App::setLocale($language);
        } else {
            App::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
