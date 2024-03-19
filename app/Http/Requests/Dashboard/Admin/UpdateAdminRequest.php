<?php

namespace App\Http\Requests\Dashboard\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
            'full_name'=>'nullable|string',
            'user_name'=>'nullable|string',
            'avatar'=>'nullable|image:jpg,png,jpeg',
            'role_id'=>'nullable|numeric|exists:roles,id',
            'phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,phone,'.$this->route('admin'),
            'email' => 'nullable|email|unique:users,email,'.$this->route('admin'),
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }
}
