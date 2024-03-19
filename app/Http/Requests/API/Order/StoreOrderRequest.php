<?php

namespace App\Http\Requests\API\Order;

use App\Http\Requests\RequestBaseAPI;

class StoreOrderRequest extends RequestBaseAPI
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
            'address_id' => 'required|exists:addresses,id',
            'payment_method' => 'required',
            'coupon_code' => "nullable",
        ];
    }
}
