<?php

namespace App\Http\Resources\API\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductcolorResource extends JsonResource
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
          'color'=>$this->color
        ];
    }
}
