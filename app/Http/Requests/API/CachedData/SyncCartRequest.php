<?php

namespace App\Http\Requests\API\CachedData;

use App\Http\Requests\RequestBaseAPI;

class SyncCartRequest extends RequestBaseAPI
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
            'products'=>'array',
            'products.*.product_id'=>'required|exists:products,id',
            'products.*.quantity'=>'required|numeric|min:1',
            'products.*.color_id'=>'nullable|exists:product_colors,id',
            'products.*.size_id'=>'nullable|exists:product_sizes,id'
        ];
    }


}
