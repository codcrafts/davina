<?php

namespace App\Http\Resources\Dashboard\Order;

use App\Http\Resources\API\Product\ProductcolorResource;
use App\Http\Resources\Dashboard\Product\ProductSizeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $name = 'name_' . app()->getLocale();
        return [
            'id' => $this->id,
            'product_id' => $this->product->id,
            'name' => $this->product->$name,
            'description' => $this->product['description_' . app()->getLocale()],
            'main_image' => $this->product->main_image_org,
            'brand_id' => $this->product->brand_id ?? null,
            'brand_name' => $this->product->brand->$name ?? '',
            'size'=>new ProductSizeResource($this->productSize),
            'color'=>new ProductcolorResource($this->productColor),
            'category_id' => $this->product->category_id ?? null,
            'category_name' => $this->product->category->$name ?? '',
            'is_offered' => $this->product->is_offered,
            'price' => $this->product->price,
            'quantity'=>$this->quantity,
            'offer_price' => $this->product->offer_price,
            'discount' => $this->product->discount,
        ];
    }
}
