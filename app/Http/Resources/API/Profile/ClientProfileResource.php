<?php

namespace App\Http\Resources\API\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientProfileResource extends JsonResource
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
            'type'=>$this->type,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'avatar'=>$this->avatar_image,
        ];
    }
}
