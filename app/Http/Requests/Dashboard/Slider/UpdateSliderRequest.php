<?php

namespace App\Http\Requests\Dashboard\Slider;

use App\Http\Requests\RequestBaseAPI;

class UpdateSliderRequest extends RequestBaseAPI
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
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
