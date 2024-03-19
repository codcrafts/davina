<?php

namespace App\Http\Requests\API;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends RequestBaseAPI
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
            'product_id'=>'nullable|exists:products,id',
            'name'=>'required|string',
            'email'=>'required|string|email',
            'phone'=>'required|string',
            'desc'=>'nullable|string'
        ];
    }
}
