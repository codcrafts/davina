<?php

namespace App\Http\Resources\Dashboard\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminDetailsResource extends JsonResource
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
            'full_name'=>$this->full_name,
            'user_name'=>$this->user_name,
            'email'=>$this->email,
            'type'=>$this->type,
            'avatar'=>asset('assets/profile.png'),
            'phone'=>$this->phone,
            'token'=>$this->when(isset($this->token),$this->token),
            'created_at'=>$this->created_at->format('d/m/Y')
        ];
    }
}
