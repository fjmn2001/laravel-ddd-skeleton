<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Http\JsonResponse;

class Cors extends Middleware
{
    public function handle($request, Closure $next)
    {
        if ($next($request) instanceof JsonResponse) {
            return $next($request)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        }

        return $next($request);
    }
}
