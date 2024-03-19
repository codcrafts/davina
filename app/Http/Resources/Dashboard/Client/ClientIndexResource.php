<?php

namespace App\Http\Resources\Dashboard\Client;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientIndexResource extends JsonResource
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
            'avatar'=>$this->avatar_image,
            'full_name'=>$this->full_name,
            'user_name'=>$this->user_name,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'type'=>$this->type,
            'is_banned'=>$this->is_banned,
            'created_at'=>$this->created_at->format('d/m/Y')
        ];
    }
}
