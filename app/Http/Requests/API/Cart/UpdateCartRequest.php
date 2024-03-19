<?php

namespace App\Http\Requests\API\Cart;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends RequestBaseAPI
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
            'quantity'=>'nullable|numeric|min:1',
        ];
    }
}
