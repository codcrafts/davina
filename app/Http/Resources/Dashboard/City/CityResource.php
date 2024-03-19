<?php

namespace App\Http\Resources\Dashboard\City;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'country_id'=>(int)$this->country_id,
            'country_name'=>$this->country->name_ar,
            'created_at'=>$this->created_at->format('d/m/Y')
        ];
    }
}
