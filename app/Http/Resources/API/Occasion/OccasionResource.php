<?php

namespace App\Http\Resources\API\Occasion;

use Illuminate\Http\Resources\Json\JsonResource;

class OccasionResource extends JsonResource
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
          'name'=>$this['name_'.app()->getLocale()]
        ];
    }
}
