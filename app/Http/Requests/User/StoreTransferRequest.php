<?php

namespace App\Http\Requests\User;

use App\Models\Account;
use App\Rules\{HasCurrentTransactionPassword, HavingMoreBalance};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account_id' => Rule::exists(Account::class, 'id'),
            'amount' => ['required', 'integer', new HavingMoreBalance($this->user()->account)],
            'password' => ['required', 'string', new HasCurrentTransactionPassword],
            'news' => ['nullable','string']
        ];
    }
}
