<?php
namespace App\Actions\User;

use App\Models\{Mutation, User};
use Illuminate\Database\Eloquent\Builder;

/**
 * 
 */
trait Withdrawing
{
    protected function searchQuery(User $user): Builder
    {
        return Mutation::where('type', 1)
        ->where('status', 0)
        ->where('account_id', $user->account->id);
    }

    protected function existing(User $user)
    {
        $existance = $this->searchQuery($user)->first();

        if ($existance && $this->rangeValidator($existance)) {
            return $existance;
        }

        return false;
    }

    private function rangeValidator(Mutation $mutation): bool
    {
        if (
            $mutation->updated_at->diffInMinutes(now()) < 60
        ) return true;

        $mutation->delete();
        return false;
    }
}
