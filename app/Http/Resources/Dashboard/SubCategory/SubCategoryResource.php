<?php

namespace App\Http\Resources\Dashboard\SubCategory;

use App\Http\Resources\Dashboard\Category\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
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
              'id'=>$this->id,
              'name_ar'=>$this->name_ar,
              'name_en'=>$this->name_en ,
              'category'=>new CategoryResource($this->category),
              'created_at'=>$this->created_at->format('d/m/Y')
        ];
    }
}
