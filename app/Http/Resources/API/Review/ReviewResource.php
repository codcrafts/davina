<?php

namespace App\Http\Resources\API\Review;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'user_id'=>$this->user->id ??null,
            'name'=>$this->user->full_name??'',
            'avatar'=>$this->user->avatar_image??'',
            'rate'=>(double)$this->rate,
            'comment'=>$this->comment ??''
        ];
    }
}
