<?php

namespace App\Http\Requests\Dashboard\Partner;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnerRequest extends RequestBaseAPI
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
            'title'=>'nullable|string',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
