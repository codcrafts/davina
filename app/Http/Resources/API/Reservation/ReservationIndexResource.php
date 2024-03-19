<?php

namespace App\Http\Resources\API\Reservation;

use App\Http\Resources\API\Country\CountryResource;
use App\Http\Resources\API\Occasion\OccasionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationIndexResource extends JsonResource
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
            'name'=>$this->name,
            'phone'=>$this->phone,
            'occasion'=>new OccasionResource($this->occasion),
            'date'=>$this->occasion_date->format('d/m/Y'),
            'created_at'=>$this->created_at->format('d/m/Y h:i A')


        ];
    }
}
