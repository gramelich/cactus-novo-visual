<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UpdateLastActivity
{
    public function handle(Request $request, Closure $next)
    {
        if (auth('api')->check()) {
            $user = auth('api')->user();
            $user->last_activity = now();
            $user->save();
        }

        return $next($request);
    }
}
