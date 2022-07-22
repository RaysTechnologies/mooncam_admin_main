<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AmountConversionStoreRequest extends FormRequest
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
            'token' => ['nullable', 'max:255', 'string'],
            'amount' => ['nullable', 'max:255', 'string'],
            'unit' => ['nullable', 'max:255', 'string'],
            'symbol' => ['nullable', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
