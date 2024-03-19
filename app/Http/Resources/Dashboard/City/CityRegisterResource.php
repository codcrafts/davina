<?php

namespace App\Http\Resources\Dashboard\City;

use Illuminate\Http\Resources\Json\JsonResource;

class CityRegisterResource extends JsonResource
{

    public function toArray($request)
    {
        $name='name_'.app()->getLocale();
        return[
            'id'=>$this->id,
            'name'=>$this->$name,
        ];
    }
}
