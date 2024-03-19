<?php

namespace App\Http\Requests\API\Review;

use App\Http\Requests\RequestBaseAPI;


class StoreReviewRequest extends RequestBaseAPI
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
            'rate'=>'required|numeric|min:0|max:5',
            'comment'=>'required|string'
        ];
    }
}
