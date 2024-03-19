<?php

namespace App\Http\Requests\Dashboard\Offer;

use App\Http\Requests\RequestBaseAPI;

class CancelOfferRequest extends RequestBaseAPI
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
            'product_id'=>'required|exists:products,id'
        ];
    }
}
