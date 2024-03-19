<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Country\CountryResource;
use App\Http\Traits\ApiResponses;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    use ApiResponses;
    public function index(){

        $countries=Country::all();

        return $this->apiResponse(CountryResource::collection($countries));
    }
}
