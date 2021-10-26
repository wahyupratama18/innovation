<?php

namespace App\Http\Requests\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateTellerRequest extends FormRequest
{
    use PasswordValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->teller && $this->user()->can('teller', $this->teller);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique(User::class, 'email')->ignore($this->teller)],
            'current_password' => [
                'required', 'string',
                fn($attr, $value, $fail) => (!Hash::check($value, $this->teller->password)
                ? $fail($attr.' yang dimasukkan kurang tepat')
                : null)
            ],
            'password' => $this->passwordRules(),
        ];
    }
}
