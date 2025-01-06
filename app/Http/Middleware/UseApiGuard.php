<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UseApiGuard
{
    public function handle($request, Closure $next): JsonResponse
    {
        Auth::shouldUse('api');

        return $next($request);
    }
}
