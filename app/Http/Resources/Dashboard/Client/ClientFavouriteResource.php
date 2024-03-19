<?php

namespace App\Http\Resources\Dashboard\Client;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientFavouriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $name='name_'.app()->getLocale();

        return [
            'id'=>$this->id,
            'name'=> $this->$name,
            'main_image'=>$this->main_image_org,
            'brand_id'=>$this->brand_id ?? null,
            'brand_name'=>$this->brand->$name ??'',
            'category_id'=>$this->category_id ?? null,
            'category_name'=>$this->category->$name ??'',
        ];
    }
}
