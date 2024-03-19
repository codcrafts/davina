<?php

namespace App\Http\Resources\Dashboard\News;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
           'image'=>$this->image_org,
          'title_ar'=>$this->title_ar,
          'title_en'=>$this->title_en,
           'desc_ar'=>$this->desc_ar,
           'desc_en'=>$this->desc_en,
           'created_at'=>$this->created_at->format('d/m/Y')

        ];
    }
}
