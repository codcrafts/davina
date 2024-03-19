<?php

namespace App\Http\Requests\Dashboard\Filter;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class ReportFilterRequest extends RequestBaseAPI
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
            'type'=>['required', 'string', 'in:day,week,month,year,arrange_date'],
            'from_date'=>'required_if:type,arrange_date|date|date_format:Y-m-d',
            'to_date'=>'required_if:type,arrange_date|date|date_format:Y-m-d|after_or_equal:from_date'
        ];
    }
}
