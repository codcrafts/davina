<?php

namespace App\Http\Resources\API\News;

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
          'title'=>$this['title_'.app()->getLocale()],
          'desc'=>$this['desc_'.app()->getLocale()],
           'created_at'=>$this->created_at->format('d/m/Y')
        ];
    }
}
