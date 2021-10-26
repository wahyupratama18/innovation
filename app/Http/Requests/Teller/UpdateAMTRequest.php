<?php

namespace App\Http\Requests\Teller;

use App\Models\Mutation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAMTRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->checkAMT($this->amt);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    private function checkAMT(Mutation $mutation): bool
    {
        return $mutation->account->balance >= $mutation->amount
        && $mutation->status == 0;
    }
}
