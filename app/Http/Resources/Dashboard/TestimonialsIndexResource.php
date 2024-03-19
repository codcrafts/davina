<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialsIndexResource extends JsonResource
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
          'name'=>$this->name,
          'image'=>$this->image_org  ,
           'desc_ar'=>$this->desc_ar,
           'desc_en'=>$this->desc_en,
            'created_at'=>$this->created_at->format('d/m/Y'),
        ];
    }
}
