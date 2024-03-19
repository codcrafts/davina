<?php

namespace App\Http\Resources\API\Product;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id'=>$this->id,
            'name'=> $this->$name,
            'rate'=>$this->rate,
            'is_available'=>$this->is_available,
            'main_image'=>$this->main_image_org,
            'brand_id'=>$this->brand_id ?? null,
            'brand_name'=>$this->brand->$name ??'',
            'category_id' => $this->category_id ?? null,
            'category_name' => $this->category->$name ?? '',
            'color_id'=>$this->color_id ??null,
            'color_name'=>$this->color->color ?? null,
            'is_favourite'=>$this->favoriteProductUsers()->where('user_id',auth('api')->id())->exists()? true: false,
            'is_offered'=>Product::where('id',$this->id)->available()->first()? 1:0,
            'price'=>$this->price,
            'offer_price'=>$this->offer_price,
            'discount'=>$this->discount
        ];
    }
}
