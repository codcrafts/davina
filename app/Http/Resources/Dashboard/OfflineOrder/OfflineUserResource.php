<?php

namespace App\Http\Resources\Dashboard\OfflineOrder;

use Illuminate\Http\Resources\Json\JsonResource;

class OfflineUserResource extends JsonResource
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
            'full_name'=>$this->full_name,
            'phone'=>$this->phone,


        ];
    }
}
