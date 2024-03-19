<?php

namespace App\Http\Resources\Dashboard\Client;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientDetailsResource extends JsonResource
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
            'full_name'=>$this->full_name,
            'user_name'=>$this->user_name,
            'phone'=>$this->phone,
            'is_banned'=>$this->is_banned,
            'email'=>$this->email,
            'avatar'=>$this->avatar_image,
        ];
    }
}
