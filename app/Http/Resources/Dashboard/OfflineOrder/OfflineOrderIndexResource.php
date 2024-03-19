<?php

namespace App\Http\Resources\Dashboard\OfflineOrder;

use App\Http\Controllers\OfflineOrderRegistration;
use Illuminate\Http\Resources\Json\JsonResource;

class OfflineOrderIndexResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'final_price'=>$this->final_price,
            'contact_data'=>new OfflineUserResource($this->user),
            'address'=> new OfflineAddressResource($this->address),
            'quantity'=>$this->orderItems->sum('quantity'),
            'created_at'=>$this->created_at->format('d/m/Y'),
        ];
    }
}
