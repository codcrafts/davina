<?php

namespace App\Http\Resources\API\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryAnotherResource extends JsonResource
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
            'name'=>$this['name_'.app()->getLocale()],
        ];
    }
}
