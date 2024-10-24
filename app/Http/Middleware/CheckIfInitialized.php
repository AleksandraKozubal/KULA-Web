<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use \Illuminate\Http\Request;



class CheckIfInitialized
{
    public function handle(Request $request, Closure $next)
    {
        if (!User::count()) {
            return redirect('/init-app');
        }

        return $next($request);
    }
}
