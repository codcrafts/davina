<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\NewsLetter\NewsLetterRequest;
use App\Http\Resources\API\Brands\BrandIndexResource;
use App\Http\Resources\API\Category\CategoryResource;
use App\Http\Resources\API\Category\SubCategoryResource;
use App\Http\Resources\API\Country\CountryResource;
use App\Http\Resources\API\Home\HomeResource;
use App\Http\Resources\API\Product\ProductCartDetailsResource;
use App\Http\Resources\API\Product\ProductcolorResource;
use App\Http\Resources\API\Product\ProductDetailsResource;
use App\Http\Resources\API\Product\ProductResource;
use App\Http\Resources\Dashboard\Occasion\OccasionResource;
use App\Http\Traits\ApiResponses;
use App\Models\{Brands, Category, NewsLetter, Occasion, Product, ProductColor, SubCategory};
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ApiResponses;
    public function index(){
        $data=[''];
        return $this->apiResponse(HomeResource::collection($data),'',200);
    }


    //all categories
    public function allCategories(){
          $categories=Category::orderBy('id', 'DESC')->get();
          return $this->apiResponse(CategoryResource::collection($categories));
    }//END OF ALL CATS

     //all products by cat id
    public function productsByCatId(Request $request){
        $products=Product::where('is_active',1)
            ->where('category_id',$request->category_id)
            ->when($request->sub_category_id, function ($q) use ($request){
                $q->where('sub_category_id',$request->sub_category_id);
            })
            ->latest()->get();
        $cat=Category::where('id',$request->category_id)->first();
        $sub_cat=SubCategory::where('id',$request->sub_category_id)->first();
        if(!$sub_cat){
            $sub_cat=null;
        }
         //return $this->apiResponse(ProductResource::collection($products));
        return ProductResource::collection($products)->additional(['cat_name'=>$cat['name_'. app()->getLocale()],
            'sub_cat_name'=>$sub_cat['name_'. app()->getLocale()],
            'status'=>true,'msg'=>'']);

    }//end of products by catID

    //product details
    public function show($id){
        //check date ???!!
      $product=Product::where('is_active',1)->find($id);

      if(!$product){
          return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
      }

      return  $this->apiResponse(new ProductDetailsResource($product),'',200);

    }//end of product details



    //all top selling
    public function topSelling(){
        $products =Product::bestSelling()->latest()->get();
        return   $this->apiResponse(ProductResource::collection($products));
    }
    public function recommendedProducts(){
        $products =Product::bestSelling()->latest()->take(2)->get();
        return   $this->apiResponse(ProductResource::collection($products));
    }

    public function AllRecommendedProducts(){
        $products =Product::bestSelling()->latest()->get();
        return   $this->apiResponse(ProductResource::collection($products));
    }

    public function topRating(){
         $products=Product::where('is_active',1)->where('rate','<>',0)->orderBy('rate', 'desc')->get();
         return   $this->apiResponse(ProductResource::collection($products));
    }


    public function getAllBrands(){
        $brands=Brands::all();
        return $this->apiResponse(BrandIndexResource::collection($brands),'',200);
    }
    public function getAllColors(){
        $brands=ProductColor::orderBy("id", "desc")->get()->unique('color');
        return $this->apiResponse(ProductcolorResource::collection($brands),'',200);
    }

    public function allProducts(){
        $products=Product::where('is_active',1)->latest()->get();
        return $this->apiResponse(ProductResource::collection($products));

    }


    //get subcategories by catID
    public function sub_categories($category_id){
        $sub_categories=SubCategory::where('category_id',$category_id)->latest()->get();
        return $this->apiResponse(SubCategoryResource::collection($sub_categories));
    }
    public function occasions(){
        $occasions=Occasion::latest()->get();
        return $this->apiResponse(CountryResource::collection($occasions));
    }

    public function categories_no_image(){
        $cats=Category::whereNull('image')->latest()->get();
        return $this->apiResponse(CategoryResource::collection($cats),'',200);
    }


    public function categories_with_image(){
        $cats=Category::whereNotNull('image')->whereHas('products')->latest()->take(4)->get();
        return $this->apiResponse(CategoryResource::collection($cats),'',200);
    }


    //subscribe to newsletter

    public function subscribe_on_news_letter(NewsLetterRequest $request){
        $subscriber = NewsLetter::where(['email' =>  $request->email])->first();
        if($subscriber){
            return response()->json(['status' => false, 'msg' => trans('app.messages.subscribed_before'), 'data' => null], 422);
        }
       NewsLetter::create($request->validated());
        return $this->apiResponse(null,trans('app.messages.added_successfully'),201);
    }



    public function productCartDetails($id){
        $product=Product::where('is_active',1)->find($id);

        if(!$product){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        return  $this->apiResponse( new ProductCartDetailsResource($product),'',200);

    }



}
