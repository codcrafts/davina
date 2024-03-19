<?php

namespace App\Http\Requests\API\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class CouponCheckRequest extends FormRequest
{

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
            'coupon_code' => "required",
        ];
    }
}
