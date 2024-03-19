<?php

namespace App\Http\Requests\Dashboard\News;

use App\Http\Requests\RequestBaseAPI;


class UpdateNewsRequest extends RequestBaseAPI
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
            'image'=>'nullable|image:jpg,png,jpeg',
            'title_ar'=>'nullable|string',
            'title_en'=>'nullable|string',
            'desc_ar'=>'nullable',
            'desc_en'=>'nullable'
        ];
    }
}
