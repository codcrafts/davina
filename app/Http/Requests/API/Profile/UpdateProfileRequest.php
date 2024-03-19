<?php

namespace App\Http\Requests\API\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,phone,'.auth()->user()->id,
            'avatar'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'email' => 'nullable|email|unique:users,email,'.auth()->user()->id,
        ];
    }
}
