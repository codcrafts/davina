<?php

namespace App\Http\Requests\API\Address;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends RequestBaseAPI
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
            'city_id'=>'nullable|exists:cities,id',
            'country_id'=>'nullable|exists:countries,id',
            'address_name'=>'nullable|string',
            'street_one'=>'nullable|string',
            'street_two'=>'nullable|string',
            'zip_code'=>'nullable|string',
        ];
    }
}
