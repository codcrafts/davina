<?php

namespace App\Http\Resources\API\Favourite;

use Illuminate\Http\Resources\Json\JsonResource;

class FavouriteResource extends JsonResource
{

    public function toArray($request)
    {

        $name = 'name_' . app()->getLocale();
          return [
               'id'=>$this->id,
               'name'=> $this->$name,
                'main_image'=>$this->main_image_org,
                'brand_id'=>$this->brand_id ?? null,
                'brand_name'=>$this->brand->$name ??'',
                'is_offered'=>$this->is_offered,
                'price'=>$this->price,
                'is_favourite' => $this->favoriteProductUsers()->where('user_id', auth('api')->id())->exists() ? true : false,
                'offer_price'=>$this->offer_price,
                'discount'=>$this->discount
        ];
    }
}
