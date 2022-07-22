<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportAndBlockUpdateRequest extends FormRequest
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
            'blocked_user_id' => ['required', 'max:255', 'string'],
            'blocked_user_name' => ['required', 'max:255', 'string'],
            'host_profile_id' => ['required', 'exists:host_profiles,id'],
        ];
    }
}
