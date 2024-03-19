<?php

namespace App\Http\Requests\Dashboard\Category;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends RequestBaseAPI
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
            'name_en'=>'nullable|string',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
