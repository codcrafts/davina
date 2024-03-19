<?php

namespace App\Http\Resources\Dashboard\OfflineOrder;

use Illuminate\Http\Resources\Json\JsonResource;

class OfflineAddressResource extends JsonResource
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
            'address'=>$this->address_name,
            'company'=>$this->company,
            'place_name'=>$this->place_name,
        ];
    }
}
