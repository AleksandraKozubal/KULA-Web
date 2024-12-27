<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UseApiGuard
{
    public function handle($request, Closure $next): Closure
    {
        Auth::shouldUse('api');

        return $next($request);
    }
}
