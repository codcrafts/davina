<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Advertisement\StoreAdsRequest;
use App\Http\Requests\Dashboard\Advertisement\UpdateAdsRequest;
use App\Http\Resources\Dashboard\Advertisement\AdsResource;
use App\Http\Traits\ApiResponses;
use App\Models\Slider;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    use ApiResponses;

    public function index()
    {
        $advertisements=Slider::whereType('ads')->orderBy('id', 'DESC')->get();
        return $this->apiResponse(AdsResource::collection($advertisements),'',200);
    }


    public function store(StoreAdsRequest $request)
    {
        Slider::create($request->validated()+['type'=>'ads']);
        return $this->apiResponse(null,trans('app.messages.added_successfully'),201);
    }


    public function show($id)
    {
        $advertisement=Slider::whereType('ads')->find($id);
        if(!$advertisement){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        return  $this->apiResponse(new AdsResource($advertisement),'',200);
    }




    public function update(UpdateAdsRequest $request, $id)
    {
        $advertisement=Slider::whereType('ads')->find($id);
        if(!$advertisement){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $advertisement->update($request->validated());
        return $this->apiResponse(null,trans('app.messages.updated_successfully'),200);
    }


    public function destroy($id)
    {
        $advertisement=Slider::whereType('ads')->find($id);
        if(!$advertisement){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }

        \File::delete(storage_path('app/public/uploads/'.$advertisement->image));
        $advertisement->delete();

        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    } //
}
