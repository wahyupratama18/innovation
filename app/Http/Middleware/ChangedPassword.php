<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChangedPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->change_pass) {
            return redirect()->route('profile.show');
        }

        return $next($request);
    }
}
