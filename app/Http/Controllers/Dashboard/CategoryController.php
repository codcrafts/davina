<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\StoreCategoryRequest;
use App\Http\Requests\Dashboard\Category\UpdateCategoryRequest;
use App\Http\Resources\Dashboard\Category\CategoryResource;
use App\Http\Traits\ApiResponses;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    use ApiResponses;

    public function index()
    {
        $cats=Category::orderBy('id', 'DESC')->get();
        return $this->apiResponse(CategoryResource::collection($cats),'',200);
    }


    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());
        return $this->apiResponse(null,trans('app.messages.added_successfully'),201);

    }


    public function show($id)
    {
        $cat=Category::find($id);
        if(!$cat){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        return  $this->apiResponse(new CategoryResource($cat),'',200);

    }




    public function update(UpdateCategoryRequest $request, $id)
    {
        $slider=Category::find($id);
        if(!$slider){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $slider->update($request->validated());
        return $this->apiResponse(null,trans('app.messages.updated_successfully'),200);
    }


    public function destroy($id)
    {
        $cat=Category::find($id);
        if(!$cat){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }

        \File::delete(storage_path('app/public/uploads/'.$cat->image));
        $cat->delete();

        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    }

    public function imageDestroy(Request $request)
    {
        $image = \DB::table('categories')->where('id', $request->id)->first();
         $file= $image->image;
        \File::delete(storage_path('app/public/uploads/'.$file));
        \DB::table('categories')->where('id', $request->id)->update(['image'=>null]);
        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);

    }



}
