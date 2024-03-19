<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\News\StoreNewsRequest;
use App\Http\Requests\Dashboard\News\UpdateNewsRequest;
use App\Http\Resources\Dashboard\News\NewsResource;
use App\Http\Traits\ApiResponses;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use ApiResponses;

    public function index()
    {
        $news=News::latest()->get();
        return $this->apiResponse(NewsResource::collection($news),'',200);
    }

    public function store(StoreNewsRequest $request)
    {
        News::create($request->validated());
        return $this->apiResponse(null,trans('app.messages.added_successfully'),201);

    }


    public function show($id)
    {
        $news=News::find($id);
        if(!$news){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        return  $this->apiResponse(new NewsResource($news),'',200);

    }




    public function update(UpdateNewsRequest $request, $id)
    {
        $news=News::find($id);
        if(!$news){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $news->update($request->validated());
        return $this->apiResponse(null,trans('app.messages.updated_successfully'),200);

    }


    public function destroy($id)
    {
        $news=News::find($id);
        if(!$news){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        \File::delete(storage_path('app/public/uploads/'.$news->image));
        $news->delete();
        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);

    }
}
