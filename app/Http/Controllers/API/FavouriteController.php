<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Favourite\StoreRequest;
use App\Http\Resources\Favourite\FavouriteResource;
use App\Http\Traits\ApiResponses;
use App\Models\Product;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    use ApiResponses;

    //add to favorites
    public function addFavourite(StoreRequest $request){

        $product=Product::where('is_active',1)->find($request->product_id);
        if(!$product){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }

        $isFavorite=auth('api')->user()->favoriteProducts()->where('product_id',$request->product_id)->count();

        if(!$isFavorite){
            auth('api')->user()->favoriteProducts()->attach($product);
            return $this->apiResponse(true,trans('app.messages.addFav'),200);
        }
        else {
            auth('api')->user()->favoriteProducts()->detach($product);
            return $this->apiResponse(false,trans('app.messages.removeFav'),200);
        }

    }

    public function myFavourites(){
        $favourites=Product::where('is_active',1)->whereHas('favoriteProductUsers', function ($query)  {
            $query->where('user_id', auth('api')->id());
        })->get();
        return $this->apiResponse(\App\Http\Resources\API\Favourite\FavouriteResource::collection($favourites));
    }

}
