<?php

namespace App\Http\Resources\API\Search;

use Illuminate\Http\Resources\Json\JsonResource;

class RececntSearchResource extends JsonResource
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
          'id' =>$this->id,
          'keyword'=>$this->keyword,
        ];
    }
}
