<?php

namespace App\Http\Requests\Dashboard\CommonQuestion;

use App\Http\Requests\RequestBaseAPI;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCommonQuestionRequest extends RequestBaseAPI
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
            'question_ar'=>'nullable|string',
            'question_en'=>'nullable|string',
            'answer_ar'=>'nullable|string',
            'answer_en'=>'nullable|string'
        ];
    }
}
