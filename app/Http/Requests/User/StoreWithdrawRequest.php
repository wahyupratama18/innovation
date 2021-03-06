<?php

namespace App\Http\Requests\User;

use App\Rules\HasCurrentTransactionPassword;
use App\Rules\HavingMoreBalance;
use Illuminate\Foundation\Http\FormRequest;

class StoreWithdrawRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'amount' => [
                'required',
                'integer',
                new HavingMoreBalance($this->user()->account)
            ],
            'password' => ['required', 'string', new HasCurrentTransactionPassword]
        ];
    }
}
