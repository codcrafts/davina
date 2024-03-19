<?php

namespace App\Http\Requests\Dashboard\Client;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends RequestBaseAPI
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
            'avatar'=>'required|image:jpg,png,jpeg',
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
