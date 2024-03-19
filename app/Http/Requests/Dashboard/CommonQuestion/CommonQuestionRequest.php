<?php

namespace App\Http\Requests\Dashboard\CommonQuestion;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class CommonQuestionRequest extends RequestBaseAPI
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
            'question_ar'=>'required|string',
            'question_en'=>'required|string',
            'answer_ar'=>'required|string',
            'answer_en'=>'required|string'
        ];
    }
}
