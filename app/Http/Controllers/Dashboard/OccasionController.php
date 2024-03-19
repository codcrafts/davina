<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Occasion\StoreOccasionRequest;
use App\Http\Requests\Occasion\UpdateOccasionRequest;
use App\Http\Resources\Dashboard\Occasion\OccasionResource;
use App\Http\Traits\ApiResponses;
use App\Models\Occasion;
use Illuminate\Http\Request;

class OccasionController extends Controller
{
    use ApiResponses;

    public function index()
    {
        $occasions=Occasion::latest()->get();
        return $this->apiResponse(OccasionResource::collection($occasions));
    }

    public function store(StoreOccasionRequest $request)
    {
        Occasion::create($request->validated());
        return $this->apiResponse(null,trans('app.messages.added_successfully'),201);
    }


    public function show($id)
    {
        $occasion=Occasion::find($id);
        if(!$occasion){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        return  $this->apiResponse(new OccasionResource($occasion),'',200);
    }

    public function update(UpdateOccasionRequest $request, $id)
    {
        $occasion=Occasion::find($id);
        if(!$occasion){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $occasion->update($request->validated());
        return $this->apiResponse(null,trans('app.messages.updated_successfully'),200);
    }


    public function destroy($id)
    {
        $occasion=Occasion::find($id);
        if(!$occasion){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $occasion->delete();
        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    }
}
