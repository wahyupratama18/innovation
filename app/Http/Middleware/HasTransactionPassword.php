<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasTransactionPassword
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
        if (!$request->user()->account->transaction_password) {
            return redirect()->route('profile.transactpass.index');
        }

        return $next($request);
    }
}
