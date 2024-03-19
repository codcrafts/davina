<?php

namespace App\Http\Requests\Dashboard\SubCategory;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Request;

class StoreSubCategoryRequest extends RequestBaseAPI
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
            'name_ar'=>'string|required',
            'name_en'=>'string|required',
            'category_id'=>'required|exists:categories,id'
        ];
    }
}
