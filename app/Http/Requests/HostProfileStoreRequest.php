<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HostProfileStoreRequest extends FormRequest
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
            'name' => ['nullable', 'max:255', 'string'],
            'age' => ['nullable', 'max:255', 'string'],
            'mobile' => ['nullable', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'gender' => ['nullable', 'max:255', 'string'],
            'photo' => ['nullable', 'file'],
            'fans_count' => ['nullable', 'max:255', 'string'],
            'followup_count' => ['nullable', 'max:255', 'string'],
            'visitor_count' => ['nullable', 'max:255', 'string'],
            'firebase_id' => ['nullable', 'max:255', 'string'],
            'token_rate_videocall' => ['nullable', 'max:255', 'string'],
            'token_rate_groupcall' => ['nullable', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
