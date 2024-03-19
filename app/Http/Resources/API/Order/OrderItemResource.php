<?php

namespace App\Http\Resources\API\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{

    public function toArray($request)
    {

        $name = 'name_' . app()->getLocale();

        return [

            'id' =>$this->id,
            'product_id'=>$this->product->id,
            'name' => $this->product->$name,
            'description'=>$this->product['description_'.app()->getLocale()],
            'main_image' => $this->product->main_image_org,
            'brand_id' => $this->product->brand_id ?? null,
            'brand_name' => $this->product->brand->$name ?? '',
            'category_id' => $this->product->category_id ?? null,
            'category_name' => $this->product->category->$name ?? '',
            'is_offered' => $this->product->is_offered,
            'price' => $this->product->price,
            'offer_price' => $this->product->offer_price,
            'discount' => $this->product->discount,
        ];
    }
}
