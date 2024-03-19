<?php

namespace App\Http\Requests\API\CachedData;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class ProductCachedRequest extends RequestBaseAPI
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
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ];
    }
}
