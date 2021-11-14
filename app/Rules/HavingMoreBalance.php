<?php

namespace App\Rules;

use App\Models\Account;
use Illuminate\Contracts\Validation\Rule;

class HavingMoreBalance implements Rule
{

    private $account;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $this->account->balance >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Akun tidak memiliki saldo yang cukup.';
    }
}
