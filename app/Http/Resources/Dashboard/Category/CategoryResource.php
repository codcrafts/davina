<?php

namespace App\Http\Resources\Dashboard\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
          'name_en'=>$this->name_en,
          'image'=>$this->image_org ,
            'created_at'=>$this->created_at->format('d/m/Y')

        ];
    }
}
