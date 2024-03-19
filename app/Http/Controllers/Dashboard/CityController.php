<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\City\StoreCityRequest;
use App\Http\Requests\Dashboard\City\UpdateCityRequest;
use App\Http\Resources\Dashboard\City\CityRegisterResource;
use App\Http\Resources\Dashboard\City\CityResource;
use App\Http\Resources\Dashboard\Role\PermissionResource;
use App\Http\Traits\ApiResponses;
use App\Models\City;
use App\Models\Permission;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use ApiResponses;

    public function index(Request $request)
    {
        $user=auth('api')->user();
        if($user->type=='admin'){
            $permissions=Permission::where(['route_name'=>$request->route_name,'role_id'=>$user->role_id])->first();
        }
        $cities=City::orderBy('id', 'DESC')->get();
        return $this->apiResponse(CityResource::collection($cities),'',200,['permissions'=>$permissions? new PermissionResource($permissions):null]);

    }




    public function store(StoreCityRequest $request)
    {
        City::create($request->validated());
        return $this->apiResponse(null,trans('app.messages.added_successfully'),201);

    }


    public function show($id)
    {
        $city=City::find($id);
        if(!$city){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);

        }
        return $this->apiResponse(new CityResource($city),'',200);
    }


    public function update(UpdateCityRequest $request, $id)
    {
        $city=City::find($id);
        if(!$city){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);

        }
        $city->update($request->validated());
        return $this->apiResponse(null,trans('app.messages.updated_successfully'),200);
    }


    public function destroy($id)
    {
        $city=City::find($id);
        if(!$city){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);

        }
        $city->delete();
        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    }

    public function cities(Request $request){
        $cities  = City::where('country_id', $request->country_id)->orderBy('id', 'DESC')->get();
        return $this->apiResponse(CityRegisterResource::collection($cities));
    }
}
