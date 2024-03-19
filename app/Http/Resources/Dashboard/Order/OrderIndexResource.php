<?php

namespace App\Http\Resources\Dashboard\Order;

use App\Http\Resources\Dashboard\Client\ClientDetailsResource;
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
        return [
            'id'=>$this->id,
            'client_details'=>new ClientDetailsResource($this->user) ?? 'تم حذف هذا العميل' ,
            'status'=>$this->status,
            'final_price'=>$this->final_price,
            'quantity'=>$this->orderItems->sum('quantity'),
            'created_at'=>$this->created_at->format('d/m/Y'),
        ];
    }
}
