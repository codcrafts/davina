<?php

namespace App\Http\Requests\Occasion;

use App\Http\Requests\RequestBaseAPI;

class UpdateOccasionRequest extends RequestBaseAPI
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
            'name_ar'=>'nullable|string',
            'name_en'=>'nullable|string'
        ];
    }
}
