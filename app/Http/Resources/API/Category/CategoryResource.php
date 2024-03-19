<?php

namespace App\Http\Resources\API\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{


    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this['name_'.app()->getLocale()] ,
            'is_have_color'=>$this->productColors()->exists() ?true :false,
            'image'=>$this->image_org ??null,
            'sub_cats'=> SubCategoryAnotherResource::collection($this->subCategories),

//                $this->whenLoaded('subCategories', function(){
//                return SubCategoryResource::collection($this->subCategories()->with('category')->get());
//            }),
        ];
    }
}
