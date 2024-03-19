<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Product\ProductResource;
use App\Http\Traits\ApiResponses;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use ApiResponses;

    public function index(){
        //check dates
         $offers=Product::available()->where('is_offered',1)->get();
         return  $this->apiResponse(ProductResource::collection($offers));
    }
}
