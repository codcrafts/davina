<?php

namespace App\Http\Resources\API\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCartDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $name = 'name_' . app()->getLocale();
        return [
            'product_id'=>$this->id,
            'product_name'=>$this['name_'.app()->getLocale()],
            'product_image'=>$this->main_image_org,
            'product_price'=>$this->price,
            'product_offer_price'=>$this->offer_price,
            'category_id' => $this->category_id ?? null,
            'category_name' => $this->category->$name ?? '',
            'is_offered'=>$this->is_offered ,

        ];
    }
}
