<?php

namespace App\Http\Requests\Dashboard\Admin;

use App\Http\Requests\RequestBaseAPI;

class StoreAdminRequest extends RequestBaseAPI
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
            'role_id'=>'nullable|numeric|exists:roles,id',
            'avatar'=>'required|image:jpg,png,jpeg',
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
