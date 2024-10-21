<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\DB;



class CheckIfInitialized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userCount = DB::table('users')->count();

        if ($userCount == 0) {
            return redirect('/init-app');
        }

        return $next($request);
    }
}
