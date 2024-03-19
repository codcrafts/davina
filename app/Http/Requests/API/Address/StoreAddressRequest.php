<?php

namespace App\Http\Requests\API\Address;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends RequestBaseAPI
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

            'city_id'=>'required|exists:cities,id',
            'country_id'=>'required|exists:countries,id',
            'address_name'=>'required|string',
            'street_one'=>'required|string',
            'street_two'=>'required|string',
            'zip_code'=>'required|string',
        ];
    }
}
