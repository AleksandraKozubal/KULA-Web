<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use \Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckIfInitialized
{
    public function handle(Request $request, Closure $next): RedirectResponse | Response
    {
        if (User::where('role', 'admin')->doesntExist()) {
            if ($request->path() !== 'init-app') {
                return redirect('/init-app');
            }
        }

        return $next($request);
    }
}
