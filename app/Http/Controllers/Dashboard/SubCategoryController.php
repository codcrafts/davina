<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SubCategory\StoreSubCategoryRequest;
use App\Http\Requests\Dashboard\SubCategory\UpdateSubCategoryRequest;
use App\Http\Resources\Dashboard\SubCategory\SubCategoryResource;
use App\Http\Traits\ApiResponses;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    use ApiResponses;

    public function index()
    {
        $sub_cats=SubCategory::latest()->get();
        return $this->apiResponse(SubCategoryResource::collection($sub_cats));
    }


    public function store(StoreSubCategoryRequest $request)
    {
        SubCategory::create($request->validated());
        return $this->apiResponse(null,trans('app.messages.added_successfully'),201);
    }


    public function show($id)
    {
        $sub_cat=SubCategory::find($id);
        if(!$sub_cat){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        return  $this->apiResponse(new SubCategoryResource($sub_cat),'',200);
    }

    public function update(UpdateSubCategoryRequest $request, $id)
    {
        $sub_cat=SubCategory::find($id);
        if(!$sub_cat){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $sub_cat->update($request->validated());
        return $this->apiResponse(null,trans('app.messages.updated_successfully'),200);
    }


    public function destroy($id)
    {
        $sub_cat=SubCategory::find($id);
        if(!$sub_cat){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $sub_cat->delete();
        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    }

    //get subcategories by catID
    public function sub_categories($category_id){
        $sub_categories=SubCategory::where('category_id',$category_id)->latest()->get();
        return $this->apiResponse(SubCategoryResource::collection($sub_categories));
    }
}
