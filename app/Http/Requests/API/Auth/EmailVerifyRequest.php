<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class EmailVerifyRequest extends RequestBaseAPI
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
            'email'=>'required|exists:users,email',
            'verification_code' => 'required|string|max:6',
            'device_type'=>'nullable',
            'device_token'=>'nullable',

        ];
    }
}
