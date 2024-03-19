<?php

namespace App\Http\Resources\API\Product;

use App\Http\Resources\API\Review\ReviewResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
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

            'id' => $this->id,
            'name' => $this->$name,
            'is_available'=>$this->is_available,
            'description'=>$this['description_'.app()->getLocale()],
            'main_image' => $this->main_image_org,
            'rate'=>(double)$this->rate,
            'brand_id' => $this->brand_id ?? null,
            'brand_name' => $this->brand->$name ?? '',
            'category_id' => $this->category_id ?? null,
            'category_name' => $this->category->$name ?? '',
            'is_favourite' => $this->favoriteProductUsers()->where('user_id', auth('api')->id())->exists() ? true : false,
            'is_offered'=>Product::where('id',$this->id)->available()->first()? 1:0,
            'price' => $this->price,
            'offer_price' => $this->offer_price,
            'discount' => $this->discount,

            'images'=>$this->images->transform(function ($q){
                return [
                    'id'=>$q->id,
                    'image'=>$q->image_org
                ];
            }),
            'sizes'=>ProductSizeResource::collection($this->sizes),
            'colors'=>ProductcolorResource::collection($this->colors),
            'specifications'=>ProductSpecificationResource::collection($this->specifications),
            'reviews'=>ReviewResource::collection($this->productReviews()->get()),
            'you_may_like'=>ProductResource::collection(Product::where('category_id',$this->category_id)
                ->where('id','!=',$this->id)
                ->inRandomOrder()
                ->limit(2) // here is yours limit
                ->get())
        ];
    }
}
