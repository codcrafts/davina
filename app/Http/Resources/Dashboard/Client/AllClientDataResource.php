<?php

namespace App\Http\Resources\Dashboard\Client;

use App\Http\Resources\API\Address\AddressResource;
use App\Http\Resources\API\Favourite\FavouriteResource;
use App\Http\Resources\Dashboard\Order\OrderIndexResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AllClientDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $name = 'name_' . app()->getLocale();
        return [
            'personal_info' => [
                'id'=>$this->id,
                'full_name'=>$this->full_name,
                'user_name'=>$this->user_name,
                'phone'=>$this->phone,
                'is_banned'=>$this->is_banned,
                'email'=>$this->email,
                'avatar'=>$this->avatar_image,
                'created_at' => $this->created_at->format('d/m/Y')
            ],
            'orders'=>OrderIndexResource::collection($this->orders),
            'addresses' => AddressResource::collection($this->addresses),
            'favourites' => ClientFavouriteResource::collection($this->favoriteProducts)

        ];
    }
}
