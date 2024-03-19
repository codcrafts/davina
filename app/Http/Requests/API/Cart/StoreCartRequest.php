<?php

namespace App\Http\Requests\API\Cart;

use App\Http\Requests\RequestBaseAPI;


class StoreCartRequest extends RequestBaseAPI
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

            'product_id'=>'required|exists:products,id',
            'quantity'=>'required|numeric|min:1',
            'color_id'=>'nullable|exists:product_colors,id',
            'size_id'=>'nullable|exists:product_sizes,id'

        ];
    }
}
