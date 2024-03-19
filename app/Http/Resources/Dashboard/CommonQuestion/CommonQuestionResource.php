<?php

namespace App\Http\Resources\Dashboard\CommonQuestion;

use Illuminate\Http\Resources\Json\JsonResource;

class CommonQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
           'id'=>$this->id,
           'question_ar'=>$this->question_ar,
           'answer_ar'=>$this->answer_ar,
            'question_en'=>$this->question_en,
           'answer_en'=>$this->answer_en,
            'created_at'=>$this->created_at->format('d/m/Y')
        ];
    }
}
