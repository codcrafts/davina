<?php

namespace App\Http\Resources\API\Order;

use App\Http\Resources\API\Address\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
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
            'order_items'=>OrderItemResource::collection($this->orderItems),
            'status'=>$this->status,
            'sub_total_price'=>$this->sub_total_price,
            'shipping_price'=>$this->shipping_price,
            'final_price'=>$this->final_price,
            'address'=>new AddressResource($this->address),
             'payment_method'=>$this->payment_method,
             'created_at'=>$this->created_at->format('d/m/Y h:i A'),
        ];
    }
}
