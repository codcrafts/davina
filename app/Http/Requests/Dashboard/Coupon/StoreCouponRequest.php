<?php

namespace App\Http\Requests\Dashboard\Coupon;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends RequestBaseAPI
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

            'coupon_discount'=>'required|numeric|between:0,99.99',
            'expired_at'=>'required|date|date_format:Y-m-d|after_or_equal:'. now()->format('Y-m-d'),
           // 'code'=>'required|unique:coupons,code',
            'number_of_use'=>'required|numeric|min:1'


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
