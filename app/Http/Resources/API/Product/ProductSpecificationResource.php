<?php

namespace App\Http\Resources\API\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductSpecificationResource extends JsonResource
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
            'id'=>$this->id ,
            'title'=>$this['title_'.app()->getLocale()],
            'body'=>$this['body_'.app()->getLocale()],
        ];
    }
}
