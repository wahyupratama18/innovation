<?php
namespace App\Actions\Admin;

use App\Models\{Account, Mutation};
use Illuminate\Database\Eloquent\{Builder, Collection};
use Illuminate\Support\Facades\Auth;

/**
 * 
 */
trait Report
{

    private static function query(int $type): Builder
    {
        return Mutation::selectRaw('sum(amount) as y, date(updated_at) as x')
        ->where('status', 1)
        ->where('type', $type)
        ->groupByRaw('x');
    }

    private function rangeQuery(int $type, string $from, string $to): Collection
    {
        return self::query($type)
        ->whereDate('updated_at', '>=', $from)
        ->whereDate('updated_at', '<=', $to)
        ->get();
    }

    private function dashboard(int $type): Collection
    {
        return self::query($type)
        ->whereDate('updated_at', '>=', now()->subWeek())
        ->get();
    }
    
    private function managedByTeller(int $type): Collection
    {
        return self::query($type)
        ->whereDate('updated_at', '>=', now()->subMonth())
        ->where('user_id', Auth::id())
        ->get();
    }

    private function userReport(Account $account): Collection
    {
        return Mutation::selectRaw('balance as y, updated_at as x')
        ->where('status', 1)
        ->where('updated_at', '>=', now()->subMonth())
        ->where('account_id', $account->id)
        ->orderByDesc('x')->get();
    }
}
