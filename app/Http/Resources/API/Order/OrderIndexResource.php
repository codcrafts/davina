<?php

namespace App\Http\Resources\API\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[

            'id'=>$this->id,
            'status'=>$this->status,
            'final_price'=>$this->final_price,
            'images'=>$this->orderItems->transform(function ($q){
                return $q->product ?$q->product->main_image_org: '';
          }),
            'created_at'=>$this->created_at->format('d/m/Y h:i A')
        ];
    }
}
