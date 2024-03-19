<?php

namespace App\Http\Requests\Dashboard\Testimonials;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class StoreTestimonialRequest extends RequestBaseAPI
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
            'name'=>'required|string',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'desc_ar'=>'required|string',
            'desc_en'=>'required|string',
        ];
    }
}
