<?php

namespace App\Http\Requests\API\Address;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class SelectAddressRequest extends RequestBaseAPI
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
            'address_id'=>'required|exists:addresses,id',
        ];
    }

    public function messages()
    {

        return [
            'address_id.required'=>'العنوان مطلوب'  ,
            'address_id.exists'=>'هذا العنوان غير موجود'
        ];
    }

}
