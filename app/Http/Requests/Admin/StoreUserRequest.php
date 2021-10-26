<?php

namespace App\Http\Requests\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\{Department, User};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    use PasswordValidationRules;

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
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique(User::class, 'email')],
            'password' => $this->passwordRules(),
            'angkatan' => 'required|integer|between:0,99',
            'department' => ['required', Rule::exists(Department::class, 'id')]
        ];
    }
}
