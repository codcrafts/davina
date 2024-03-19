<?php

namespace App\Http\Resources\Dashboard\Contact;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactIndexResource extends JsonResource
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
          'name'=>$this->name,
          'product_id'=>$this->product_id,
          'phone'=>$this->phone,
          'email'=>$this->email,
          'created_at'=>$this->created_at->format('d/m/Y')
        ];
    }
}
