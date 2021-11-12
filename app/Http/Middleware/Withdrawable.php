<?php

namespace App\Http\Middleware;

use App\Actions\User\Withdrawing;
use App\Models\Mutation;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Withdrawable
{
    use Withdrawing;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $type)
    {
        if ($type == 'exist' && $this->emptyWithdraw($request)) {
            return redirect()->route('withdraw.create');
        } else if ($type == 'empty' && $this->havingWithdraw($request)) {
            return redirect()->route('withdraw.show');
        }

        return $next($request);
    }

    private function emptyWithdraw(Request $request): bool
    {
        return $this->existing($request->user()) ? false : true;
    }

    private function havingWithdraw(Request $request): bool
    {
        return $this->searchQuery($request->user())->exists();
    }
}
