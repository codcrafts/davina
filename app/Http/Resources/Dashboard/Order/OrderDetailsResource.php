<?php

namespace App\Http\Resources\Dashboard\Order;

use App\Http\Resources\API\Address\AddressResource;
use App\Http\Resources\Dashboard\Client\ClientDetailsResource;
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
            'client_details'=>new ClientDetailsResource($this->user),
            'order_items'=>OrderItemResource::collection($this->orderItems),
            'status'=>$this->status,
            'sub_total_price'=>$this->sub_total_price,
            'shipping_price'=>$this->shipping_price,
            'address'=>new AddressResource($this->address),
            'final_price'=>$this->final_price,
            'quantity'=>$this->orderItems->sum('quantity'),
            'created_at'=>$this->created_at->format('d/m/Y'),

        ];
    }
}
