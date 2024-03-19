<?php

namespace App\Http\Resources\Dashboard\Partner;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnerIndexResource extends JsonResource
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
            'title'=>$this->title,
            'image'=>$this->image_org,
            'created_at'=>$this->created_at->format('d/m/Y')
        ];
    }
}
