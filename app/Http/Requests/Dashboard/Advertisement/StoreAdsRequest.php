<?php

namespace App\Http\Requests\Dashboard\Advertisement;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdsRequest extends RequestBaseAPI
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
             'title_ar'=>'required|string',
             'title_en'=>'required|string',
               'link'=>'nullable|string',
             'image'=>'required|image:jpg,png,jpeg',
        ];
    }
}
