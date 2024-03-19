<?php

namespace App\Http\Requests\API\Order;

use App\Http\Requests\RequestBaseAPI;

class TrackOrderRequest extends RequestBaseAPI
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
            'order_id'=>'required|exists:orders,id',
            'email'=>'required|exists:users,email'
        ];
    }
}
