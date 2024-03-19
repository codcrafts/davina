<?php

namespace App\Http\Resources\Dashboard\Country;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
           'name_ar'=>$this->name_ar,
           'name_en'=>$this->name_en,
           'created_at'=>$this->created_at->format('d/m/Y'),
        ];
    }
}
