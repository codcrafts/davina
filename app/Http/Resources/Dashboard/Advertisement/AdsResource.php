<?php

namespace App\Http\Resources\Dashboard\Advertisement;

use Illuminate\Http\Resources\Json\JsonResource;

class AdsResource extends JsonResource
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
          'title_ar'=>$this->title_ar,
          'title_en'=>$this->title_en,
          'link'=>$this->link ??'',
          'image'=>$this->image_org,
            'created_at'=>$this->created_at->format('d/m/Y')
        ];
    }
}
