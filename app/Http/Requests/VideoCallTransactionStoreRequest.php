<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoCallTransactionStoreRequest extends FormRequest
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
            'sender_id' => ['nullable', 'max:255', 'string'],
            'call_duration' => ['nullable', 'max:255', 'string'],
            'token_charge' => ['nullable', 'max:255', 'string'],
            'host_profile_id' => ['required', 'exists:host_profiles,id'],
        ];
    }
}
