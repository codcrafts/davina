<?php

namespace App\Http\Resources\Dashboard\Slider;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title_ar'=>$this->title_ar,
            'title_en'=>$this->title_en,
            'image'=>$this->image_org,
            'created_at'=>$this->created_at->format('d/m/Y')
        ];
    }
}
