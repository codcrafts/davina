<?php

namespace App\Http\Resources\Dashboard\Country;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryRegisterResource extends JsonResource
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
