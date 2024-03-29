<?php

namespace App\Http\Resources\API\Country;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $name = 'name_'.app()->getLocale();
        return
            [
                'id'=>$this->id,
                'name'=>$this->$name,

            ];
    }
}
