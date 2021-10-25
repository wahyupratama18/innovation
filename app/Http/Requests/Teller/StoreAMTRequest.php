<?php

namespace App\Http\Requests\Teller;

use App\Models\Account;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAMTRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'account_id' => [
                'required',
                Rule::exists(Account::class, 'id')
                ->where(fn($query) => $query->where('balance', '>=', $this->amount))
            ],
            'amount' => 'required|integer'
        ];
    }
}
