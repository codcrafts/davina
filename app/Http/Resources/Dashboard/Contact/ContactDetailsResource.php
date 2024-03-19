<?php

namespace App\Http\Resources\Dashboard\Contact;

use App\Http\Resources\Dashboard\Product\ProductIndexResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactDetailsResource extends JsonResource
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
            'phone'=>$this->phone,
            'email'=>$this->email,
            'desc'=>$this->desc,
            'product'=>new ProductIndexResource($this->product),
            'created_at'=>$this->created_at->format('d/m/Y')
        ];
    }
}
