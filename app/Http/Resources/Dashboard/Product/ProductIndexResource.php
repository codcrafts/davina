<?php

namespace App\Http\Resources\Dashboard\Product;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductIndexResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name_ar'=>$this->name_ar,
            'name_en'=>$this->name_en,
            'description_ar'=>$this->description_ar,
            'description_en'=>$this->description_en,
            'main_image'=>$this->main_image_org,
            'brand_id'=>$this->brand_id,
            'is_offered'=>$this->is_offered,
            'is_available'=>$this->is_available,
            'offer_price'=>$this->offer_price??null,
            'discount'=>$this->discount??null,

            'start_date'=>Carbon::parse($this->start_date)->format('Y-m-d') ??null,
            'end_date'=>Carbon::parse($this->end_date)->format('Y-m-d') ?? null,
            'rate'=>$this->rate,
            'is_active'=>$this->is_active,
            'brand_name'=>$this->brand->name_ar ??'',
            'category_id'=>$this->category_id,
            'category_name'=>$this->category->name_ar ??'',
            'price'=>$this->price,
//            'images'=>$this->images->transform(function ($q){
//                return [
//                    'id'=>$q->id,
//                    'image'=>$q->image_org
//                ];
//            }),
//            'sizes'=>ProductSizeResource::collection($this->sizes),
//            'colors'=>ProductColorResource::collection($this->colors),
//            'specifications'=>ProductSpecificationResource::collection($this->specifications),
            'created_at'=>$this->created_at->format('d/m/Y'),


        ];
    }
}
