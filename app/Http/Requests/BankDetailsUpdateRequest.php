<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankDetailsUpdateRequest extends FormRequest
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
            'name' => [ 'max:255', 'required'],
            'address' => ['max:255','required'],
            'mobile' => [ 'max:225','required'],
            'email' => [ 'max:225', 'email'],
            'account_no' => ['required'],
            'ifsc' => [ 'max:225', 'required'],
            'upiid_1' => [ 'max:225'],
            'upiid_2' => [ 'max:225'],
            'host_profile_id' => ['required', 'exists:host_profiles,id'],
        ];
    }
}
