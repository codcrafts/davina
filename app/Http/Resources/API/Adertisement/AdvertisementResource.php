<?php

namespace App\Http\Resources\API\Adertisement;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
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
           'title'=>$this['title_'.app()->getLocale()],
           'image'=>$this->image_org,
           'link'=>$this->link,
        ];
    }
}
