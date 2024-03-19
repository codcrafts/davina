<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Brand\StoreBrandRequest;
use App\Http\Requests\Dashboard\Brand\UpdateBrandRequest;

use App\Http\Resources\Dashboard\Brand\BrandIndexResource;
use App\Http\Resources\Dashboard\Country\CountryResource;
use App\Http\Traits\ApiResponses;
use App\Models\Brands;


class BrandController extends Controller
{


    use ApiResponses;

    public function index()
    {
        $brands = Brands::orderBy('id', 'DESC')->get();
        return $this->apiResponse(BrandIndexResource::collection($brands), '', 200);
    }

    public function store(StoreBrandRequest $request)
    {
        Brands::create($request->validated());
        return $this->apiResponse(null, trans('app.messages.added_successfully'), 201);

    }

    public function update(UpdateBrandRequest $request, $id)
    {
        $brand = Brands::find($id);
        if (!$brand) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $brand->update($request->validated());
        return $this->apiResponse(null, trans('app.messages.updated_successfully'), 200);

    }

    public function show($id)
    {
        $brand = Brands::find($id);
        if (!$brand) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        return $this->apiResponse(new BrandIndexResource($brand), '', 200);
    }


    public function destroy($id)
    {
        $brand = Brands::find($id);
        if (!$brand) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $brand->delete();
        return $this->apiResponse(null, trans('app.messages.deleted_successfully'), 200);
    }
}
