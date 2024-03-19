<?php

namespace App\Http\Requests\Dashboard\Product;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends RequestBaseAPI
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
            'description_ar'=>'nullable|min:3|max:1000',
            'description_en'=>'nullable|min:3|max:1000',
            'main_image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'brand_id'=>'nullable|exists:brands,id',
            'category_id'=>'nullable|exists:categories,id',
            'sub_category_id'=>'nullable|exists:sub_categories,id',
            'price'=>'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'sizes'=> 'nullable|array',
            'sizes.*'=>'nullable|string',
            'colors'=>'nullable|array',
            'colors.*'=>'nullable|string',
            'specifications'=>'nullable|array',
            'specifications.*'=>'nullable|array',
            'specifications.*.title_ar'=>'nullable|string',
            'specifications.*.title_en'=>'nullable|string',
            'specifications.*.body_ar'=>'nullable|string',
             'specifications.*.body_en'=>'nullable|string',
             'discount'=>'nullable|numeric|between:0,99.99',
             'end_date'=>'nullable|date|date_format:Y-m-d|after:'. now()->format('Y-m-d'),
        ];
    }

    public function getValidatorInstance()
    {
         $data = $this->all();
        $discount=null;
        $end_date=null;
        if (isset($data['discount']) && is_numeric($data['discount'])) {
            $discount=$data['discount'];
            $end_date=$data['end_date'];
        }
        $data['discount'] = $discount;
        $data['end_date'] = $end_date;

        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }

}
