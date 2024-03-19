<?php

namespace App\Http\Requests\Dashboard\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
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
            'coupon_discount'=>'nullable|numeric|between:0,99.99',
            'expired_at'=>'nullable|date|date_format:Y-m-d|after_or_equal:'. now()->format('Y-m-d'),
            // 'code'=>'nullable|unique:coupons,code',
            'number_of_use'=>'nullable|numeric|min:1'

        ];
    }
    public function messages()
    {
        return [
            'expired_at.required'=>'تاريخ الإنتهاء مطلوب'  ,
            'expired_at.after_or_equal'=>'يجب ان يكون تاريخ الإنتهاء مساوا او لاحقا لتاريخ اليوم'  ,
        ];

    }


}
