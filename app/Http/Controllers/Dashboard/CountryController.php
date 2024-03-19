<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Country\StoreCountryRequest;
use App\Http\Requests\Dashboard\Country\UpdateCountryRequest;
use App\Http\Resources\Dashboard\Country\CountryRegisterResource;
use App\Http\Resources\Dashboard\Country\CountryResource;
use App\Http\Traits\ApiResponses;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    use ApiResponses;

    public function index()
    {
        $countries=Country::orderBy('id', 'DESC')->get();
        return $this->apiResponse(CountryResource::collection($countries),'',200);
    }

    public function store(StoreCountryRequest $request)
    {
        Country::create($request->validated());
        return $this->apiResponse(null,trans('app.messages.added_successfully'),201);

    }

    public function update(UpdateCountryRequest $request, $id)
    {
        $country=Country::find($id);
        if(!$country){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $country->update($request->validated());
        return $this->apiResponse(null,trans('app.messages.updated_successfully'),200);

    }
    public function show($id)
    {
        $country=Country::find($id);
        if(!$country){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        return  $this->apiResponse(new CountryResource($country),'',200);
    }


    public function destroy($id)
    {
        $country=Country::find($id);
        if(!$country){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
            }
        $country->delete();
        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    }

    //for register
    public function allCountries(){
        $countries=Country::orderBy('id', 'DESC')->get();
        return $this->apiResponse(CountryRegisterResource::collection($countries),'',200);
    }


}
