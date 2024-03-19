<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Requests\RequestBaseAPI;

class SocialSignUpRequest extends RequestBaseAPI
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
            'full_name'=>'required|string',
            'user_name'=>'required|string',
            'phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|email',
            'provider_type'=>'required|in:facebook,google',
            'access_token'=>'required|string',
            'device_type'=>'nullable|string',
            'device_token'=>'nullable|string'
        ];
    }
}
