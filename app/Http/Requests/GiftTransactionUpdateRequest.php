<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GiftTransactionUpdateRequest extends FormRequest
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
            'reciever_id' => ['nullable', 'max:255', 'string'],
            'sender_id' => ['required', 'max:255', 'string'],
            'gift_id' => ['nullable', 'max:255', 'string'],
            'gift_name' => ['nullable', 'max:255', 'string'],
            'token' => ['nullable', 'max:255', 'string'],
            'host_profile_id' => ['required', 'exists:host_profiles,id'],
        ];
    }
}
