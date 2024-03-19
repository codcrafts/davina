<?php

namespace App\Http\Resources\API\CommonQestion;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResoure extends JsonResource
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
            'question'=>$this['question_' . app()->getLocale()],
            'answer'=>$this['answer_' . app()->getLocale()],
        ];
    }
}
