<?php

namespace App\Http\Requests\Dashboard\Brand;

use App\Http\Requests\RequestBaseAPI;


class UpdateBrandRequest extends RequestBaseAPI
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
            'name_ar'=>'nullable|string',
            'name_en'=>'nullable|string'
        ];
    }
}
