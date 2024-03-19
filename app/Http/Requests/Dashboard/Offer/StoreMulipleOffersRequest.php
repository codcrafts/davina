<?php

namespace App\Http\Requests\Dashboard\Offer;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class StoreMulipleOffersRequest extends RequestBaseAPI
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
            'ids' => 'required|array',
            'ids.*' => 'exists:products,id',
            'discount'=>'required|numeric|between:0,99.99',
            'end_date'=>'required|date|date_format:Y-m-d|after:'. now()->format('Y-m-d'),
        ];
    }
}
