<?php

namespace App\Http\Requests\Dashboard\News;

use App\Http\Requests\RequestBaseAPI;


class StoreNewsRequest extends  RequestBaseAPI
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
            'image'=>'required|image:jpg,png,jpeg',
            'title_ar'=>'required|string',
            'title_en'=>'required|string',
            'desc_ar'=>'required',
            'desc_en'=>'required'
        ];
    }
}
