<?php

namespace App\Http\Resources\Dashboard\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductSizeResource extends JsonResource
{

    public function toArray($request)
    {
        return [
          'id'=>$this->id,
          'size'=>$this->size
        ];
    }
}
