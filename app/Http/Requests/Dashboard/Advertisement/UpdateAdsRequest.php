<?php

namespace App\Http\Requests\Dashboard\Advertisement;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdsRequest extends RequestBaseAPI
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
            'title_ar'=>'nullable|string',
            'title_en'=>'nullable|string',
            'link'=>'nullable|string',
            'image'=>'nullable|image:jpg,png,jpeg',
        ];
    }
}
