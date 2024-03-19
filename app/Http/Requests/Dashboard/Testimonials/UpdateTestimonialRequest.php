<?php

namespace App\Http\Requests\Dashboard\Testimonials;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialRequest extends RequestBaseAPI
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
            'name'=>'nullable|string',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'desc_ar'=>'nullable|string',
            'desc_en'=>'nullable|string',
        ];
    }
}
