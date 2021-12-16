<?php

namespace App\Http\Requests\User;

use App\Rules\ValidatePeriod;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidateMutationHistoryRequest extends FormRequest
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
            'type' => [
                'required',
                Rule::in(['period', 'date'])
            ],
            'period' => [
                new ValidatePeriod($this->type),
            ],
            'from' => [
                'nullable',
                'required_if:type,date',
                'date'
            ],
            'to' => [
                'nullable',
                'required_if:type,date',
                'date',
                'after_or_equal:from',
                'before_or_equal:'.Carbon::parse($this->from)->addMonth(),
                'before_or_equal:today'
            ],
        ];
    }
}
