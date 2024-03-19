<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfflineOrderRegistrationRequest extends RequestBaseAPI
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
        //commenttttt
        return [
            'contact' => ['required', 'array'],
            'contact.full_name' => ['required', 'string'],
            'contact.phone' => ['required', 'string'],
            'contact.address' => ['required', 'string'],
            'contact.company'=>['nullable','string'],
            'contact.place_name'=>['required','string'],
            'products' => ['required', 'array', 'min:1'],
            'products.*.product_id' => ['required', 'exists:products,id'],
            'products.*.product_quantity' => ['required', 'numeric'],
            'products.*.color_id' => ['nullable', 'numeric', 'exists:product_colors,id'],
            'products.*.size_id' => ['nullable', 'numeric', 'exists:product_sizes,id'],
            'coupon_code' => 'nullable|string',
        ];
    }
}
