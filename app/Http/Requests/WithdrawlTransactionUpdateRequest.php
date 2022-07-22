<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawlTransactionUpdateRequest extends FormRequest
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
            'total_amount' => ['nullable', 'max:255', 'string'],
            'recieved_amount' => ['nullable', 'max:255', 'string'],
            'commision' => ['nullable', 'max:255', 'string'],
            'status' => ['nullable', 'max:255', 'string'],
            'date' => ['nullable', 'date'],
            'host_profile_id' => ['required', 'exists:host_profiles,id'],
        ];
    }
}
