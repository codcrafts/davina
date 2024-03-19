<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Filter\FilterRequest;
use App\Http\Requests\API\Filter\WebsiteFilterRequest;
use App\Http\Resources\API\Product\ProductResource;
use App\Http\Traits\ApiResponses;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    use ApiResponses;

    public function index(FilterRequest $request){
//        whereDate('start_date','<=',now()->format('d/m/Y'))
//            ->whereDate('end_date','>=',now()->format('d/m/Y'))//dont forget this
        $products=Product::where('is_active',1)

             ->when($request->rate,function ($q) use ($request) {
                 $q->where('rate', '=', $request->rate);
                })
            ->when($request->popularity=='popularity',function ($q) use ($request) {
                $q->withCount('favoriteProductUsers');
                $q->whereHas('favoriteProductUsers');
                $q->latest('favorite_product_users_count');
//                $q->whereHas('favoriteProductUsers', function ($query) {
//                    $query->where('product_id',DB::raw('COUNT(product_id) as count'))
//                        ->groupBy('product_id')
//                        ->orderBy('count', 'desc');
//                    $query->withCount('favoriteProductUsers');

//                });
            })->when($request->brand_id, function ($q) use ($request) {
                     $q->where('brand_id', $request->brand_id);

                })->when($request->color,function ($q) use ($request) {
                $q->whereHas('colors', function ($query) use ($request) {
                    $query->where('color', '=', $request->color);
                });
                 })->when($request->min_price && $request->max_price,function ($q) use ($request){
                      $min=$request->min_price;
                      $max= $request->max_price;
                   $q->whereBetween('price', [$min,$max ]);
                   $q->orWhereBetween('offer_price',[$min,$max ]);

                 })->latest()->get();
//                dd($products);
               return $this->apiResponse(ProductResource::collection($products));

             }

             //website filter
    public function filter(WebsiteFilterRequest $request){
//        whereDate('start_date','<=',now()->format('d/m/Y'))
//            ->whereDate('end_date','>=',now()->format('d/m/Y'))//dont forget this
        $products=Product::where('is_active',1)
            ->when($request->category_id, function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
                    })
            ->when($request->sub_category_id, function ($q) use ($request) {
                $q->where('sub_category_id', $request->sub_category_id);
            })
            ->when($request->rate,function ($q) use ($request) {
                $q->where('rate', '=', $request->rate);
            })
            ->when($request->popularity=='popularity',function ($q) use ($request) {
                $q->withCount('favoriteProductUsers');
                $q->whereHas('favoriteProductUsers');
                $q->latest('favorite_product_users_count');
//                $q->whereHas('favoriteProductUsers', function ($query) {
//                    $query->where('product_id',DB::raw('COUNT(product_id) as count'))
//                        ->groupBy('product_id')
//                        ->orderBy('count', 'desc');
//                    $query->withCount('favoriteProductUsers');

//                });
            })->when($request->brand_id, function ($q) use ($request) {
                $q->where('brand_id', $request->brand_id);

            })->when($request->color,function ($q) use ($request) {
                $q->whereHas('colors', function ($query) use ($request) {
                    $query->where('color', '=', $request->color);
                });
            })->when($request->min_price && $request->max_price,function ($q) use ($request){
                $q->where(function ($q)use($request){
                    $min=$request->min_price;
                    $max= $request->max_price;
                    $q->whereBetween('price', [$min,$max ]);
                    $q->orWhereBetween('offer_price',[$min,$max ]);
                });

            })->latest()->get();
//                dd($products);
        return $this->apiResponse(ProductResource::collection($products));

    }


}
