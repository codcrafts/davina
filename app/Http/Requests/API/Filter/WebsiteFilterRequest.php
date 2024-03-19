<?php

namespace App\Http\Requests\API\Filter;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class WebsiteFilterRequest extends RequestBaseAPI
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
            'category_id'=>'nullable|exists:categories,id',
            'sub_category_id'=>'nullable|exists:sub_categories,id',
            'brand_id'=>'nullable|exists:brands,id',
            'rate'=>'nullable|numeric|min:0|max:5',
            'color'=>'nullable',
            'popularity'=>'nullable',
            'min_price' =>'nullable|integer|min:1',
            'max_price' => 'nullable|integer',
        ];
    }
}
