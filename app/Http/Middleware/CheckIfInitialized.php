<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use \Illuminate\Http\Request;



class CheckIfInitialized
{
    public function handle(Request $request, Closure $next)
    {
        if (User::where('role', 'admin')->doesntExist()) {
            if ($request->path() !== 'init-app') {
                return redirect('/init-app');
            }
        }

        return $next($request);
    }
}
