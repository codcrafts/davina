<?php

namespace App\Http\Resources\API\Cart;

use App\Http\Resources\API\Product\ProductResource;
use App\Http\Resources\CartTTT;
use App\Http\Resources\Dashboard\Product\ProductIndexResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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

             'cart_id'=>$this->id,
             'product_id'=>(int)optional($this->product)->id,
             'product_name'=>optional($this->product)['name_'.app()->getLocale()],
             'category_id'=>optional(optional($this->product)->category)->id,
             'category_name'=>optional(optional($this->product)->category)['name_'.app()->getLocale()],
             'product_quantity'=>(int)$this->quantity,
             'color_id'=>$this->color_id ??null,
             'color_name'=>$this->color->color ?? null,
             'size_id'=>$this->size_id ?? null,
             'size_name'=>$this->size->size ??null,
              'is_offered'=>optional($this->product)->is_offered ,
             'product_image'=>optional($this->product)->main_image_org,
             'product_price'=>optional($this->product)->price ,
             'product_offer_price'=>optional($this->product)->offer_price ?? null,
             'items_price'=>optional($this->product)->offer_price?(optional($this->product)->offer_price*$this->quantity):(optional($this->product)->price*$this->quantity),
        ];

    }
}
