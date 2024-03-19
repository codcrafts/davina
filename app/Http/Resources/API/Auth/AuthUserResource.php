<?php

namespace App\Http\Resources\API\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
{

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
            'token'=>$this->when(isset($this->token),$this->token),
        ];
    }
}
