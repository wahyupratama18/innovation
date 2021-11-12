<?php

namespace App\Http\Requests\User;

use App\Rules\HasCurrentTransactionPassword;
use Illuminate\Foundation\Http\FormRequest;
use Laravel\Fortify\Rules\Password;

class StoreTransactionPasswordRequest extends FormRequest
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
            'current_password' => [new HasCurrentTransactionPassword],
            'password' => [
                'required',
                'confirmed',
                (new Password)->requireUppercase()->requireNumeric(),
                'string'
            ]
        ];
    }
}
