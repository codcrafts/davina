<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Partner\StorePartnerRequest;
use App\Http\Requests\Dashboard\Partner\UpdatePartnerRequest;
use App\Http\Resources\Dashboard\Partner\PartnerIndexResource;
use App\Http\Traits\ApiResponses;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    use ApiResponses;

    public function index()
    {
        $partners=Partner::orderBy('id', 'DESC')->get();
        return $this->apiResponse(PartnerIndexResource::collection($partners),'',200);
    }





    public function store(StorePartnerRequest $request)
    {
      Partner::create($request->validated());
        return $this->apiResponse(null,trans('app.messages.added_successfully'),201);
    }


    public function show($id)
    {
        $partner=Partner::find($id);
        if(!$partner){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        return  $this->apiResponse(new PartnerIndexResource($partner),'',200);

    }


    public function update(UpdatePartnerRequest $request, $id)
    {
        $partner=Partner::find($id);
        if(!$partner){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $partner->update($request->validated());
        return $this->apiResponse(null,trans('app.messages.updated_successfully'),200);
    }


    public function destroy($id)
    {
        $partner=Partner::find($id);
        if(!$partner){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        \File::delete(storage_path('app/public/uploads/'.$partner->image));
        $partner->delete();

        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    }

}
