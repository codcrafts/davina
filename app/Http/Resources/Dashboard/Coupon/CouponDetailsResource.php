<?php

namespace App\Http\Resources\Dashboard\Coupon;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'coupon_discount' => $this->coupon_discount,
            'code'=>$this->code,
            'expired_at' => $this->expired_at,
            'number_of_use' => $this->number_of_use,
            'created_at' => $this->created_at->format('d/m/Y')
        ];
    }
}
