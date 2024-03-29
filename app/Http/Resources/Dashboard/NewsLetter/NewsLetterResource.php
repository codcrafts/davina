<?php

namespace App\Http\Resources\Dashboard\NewsLetter;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsLetterResource extends JsonResource
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
          'email'=>$this->email,
          'created_at'=>$this->created_at->format('d/m/Y')
        ];
    }
}
