<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CallPriceStoreRequest extends FormRequest
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
            'video_call' => ['nullable', 'max:255', 'string'],
            'live_streaming' => ['nullable', 'max:255', 'string'],
            'video_call_price_limit' => ['nullable', 'max:255', 'string'],
            'live_streaming_call_price_limit' => [
                'nullable',
                'max:255',
                'string',
            ],
            'photo_price' => ['nullable', 'max:255', 'string'],
            'host_profile_id' => ['required', 'exists:host_profiles,id'],
        ];
    }
}
