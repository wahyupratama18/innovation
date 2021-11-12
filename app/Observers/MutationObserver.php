<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Mutation;

class MutationObserver
{

    private function balancer(Account $account, int $amount, int $type): int
    {
        $newBalance = ($type == 0
        ? $account->balance + $amount
        : $account->balance - $amount);

        $account->forceFill([
            'balance' => $newBalance
        ])->save();

        return $newBalance;
    }

    /**
     * Handle the Mutation "created" event.
     *
     * @param  \App\Models\Mutation  $mutation
     * @return void
     */
    public function creating(Mutation $mutation)
    {
        if ($mutation->status !== 0) {
            $mutation->status = 1;
            $mutation->balance = $this->balancer(
                $mutation->account,
                $mutation->amount,
                $mutation->type
            );
        } else $mutation->balance = 0;
    }

    /**
     * Handle the Mutation "updated" event.
     *
     * @param  \App\Models\Mutation  $mutation
     * @return void
     */
    public function updated(Mutation $mutation): void
    {
        $mutation->balance = $this->balancer(
            $mutation->account,
            $mutation->amount,
            $mutation->type
        );
    }

    /**
     * Handle the Mutation "deleted" event.
     *
     * @param  \App\Models\Mutation  $mutation
     * @return void
     */
    public function deleted(Mutation $mutation)
    {
        //
    }

    /**
     * Handle the Mutation "restored" event.
     *
     * @param  \App\Models\Mutation  $mutation
     * @return void
     */
    public function restored(Mutation $mutation)
    {
        //
    }

    /**
     * Handle the Mutation "force deleted" event.
     *
     * @param  \App\Models\Mutation  $mutation
     * @return void
     */
    public function forceDeleted(Mutation $mutation)
    {
        //
    }
}
