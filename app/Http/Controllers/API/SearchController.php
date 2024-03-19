<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Search\KeywordSearchRequest;
use App\Http\Requests\API\Search\SearchRequest;
use App\Http\Resources\API\Product\ProductResource;
use App\Http\Resources\API\Search\RececntSearchResource;
use App\Http\Resources\Dashboard\Product\ProductIndexResource;
use App\Http\Traits\ApiResponses;
use App\Models\Product;
use App\Models\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SearchController extends Controller
{
    use ApiResponses;

    public function search(SearchRequest $request)
    {

        $products = Product::where('is_active',1)->where('name_ar' , 'LIKE', "%{$request->name}%")
                             ->orWhere('name_en' , 'LIKE', "%{$request->name}%")
                             ->orderBy('id', 'DESC')->get();
        return $this->apiResponse(ProductResource::collection($products),'',200);
    }


    //store keyword search
    public function store(KeywordSearchRequest $request){
          $searches=Search::create($request->validated()+['user_id'=>auth('api')->id()]);
        return $this->apiResponse(null,trans('app.messages.added_successfully'),201);
    }

    public function recentSearches(){
        $searches=Search::where('user_id',auth('api')->id())
                         ->orderBy("id", "desc")->take(10)->get()->unique('keyword');
        return $this->apiResponse(RececntSearchResource::collection($searches),'',200);

    }

    public function deleteSearches(){
        auth('api')->user()->searches()->delete();
        return $this->apiResponse(null, trans('app.messages.deleted_successfully'), 200);

    }

//    public function autoComplete(Request $request){
//        $searches=Search::where('keyword',"LIKE","%{$request->input('keyword')}%")
//                           ->get();
//        return $this->apiResponse()
//




}
