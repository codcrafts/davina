<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\City\CityResource;
use App\Http\Traits\ApiResponses;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use ApiResponses;

    public function index(Request $request){

//        $cities=City::all();
        $cities  = City::where('country_id', $request->country_id)->get();
        return $this->apiResponse(CityResource::collection($cities));
    }
}
