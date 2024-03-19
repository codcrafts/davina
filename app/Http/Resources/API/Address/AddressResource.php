<?php

namespace App\Http\Resources\API\Address;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'address_name'=>$this->address_name,
            'street_one'=>$this->street_one,
            'street_two'=>$this->street_two,
            'zip_code'=>$this->zip_code,
            'is_default'=>$this->is_default,
            'city_id'=>(int)$this->city_id,
            'city_name'=>$this->city->$name ??'',
            'country_id'=>(int)$this->country_id,
            'country_name'=>$this->country->$name ??'',

        ];
    }
}
