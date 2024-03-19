<?php

namespace App\Http\Resources\Dashboard\OfflineOrder;

use App\Http\Resources\API\Address\AddressResource;
use App\Http\Resources\Dashboard\Order\OrderItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OfflineOrderDetailsResource extends JsonResource
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
            'contact_data'=>new OfflineUserResource($this->user),
            'address'=> new OfflineAddressResource($this->address),
            'order_items'=>OrderItemResource::collection($this->orderItems),
           // 'status'=>$this->status,
            'sub_total_price'=>$this->sub_total_price,
            'shipping_price'=>$this->shipping_price,
            'final_price'=>$this->final_price,
            'quantity'=>$this->orderItems->sum('quantity'),
            'created_at'=>$this->created_at->format('d/m/Y'),
        ];
    }
}
