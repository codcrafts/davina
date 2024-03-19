<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\StoreProductRequest;
use App\Http\Requests\Dashboard\Product\UpdateProductRequest;
use App\Http\Resources\Dashboard\Product\ProductDetailsResource;
use App\Http\Resources\Dashboard\Product\ProductIndexResource;
use App\Http\Traits\ApiResponses;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\Specification;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponses;

    public function index()
    {
        $products=Product::orderBy('id', 'DESC')->get();
        return $this->apiResponse(ProductIndexResource::collection($products),'',200);

    }//end of all products


    public function store(StoreProductRequest $request)
    {

        $product = Product::create(array_except($request->validated(), ['images', 'colors', 'sizes', 'specifications']) + ['is_active' => true]);

        if($request->images) {
            foreach ($request->images as $key) {
                $product->images()->create(['image' => $key]);
            }
        }
         if($request->colors) {
             foreach ($request->colors as $key) {
                 $product->colors()->create(['color' => $key]);
             }
         }
         //size
         if($request->sizes) {
             foreach ($request->sizes as $key) {
                 $product->sizes()->create(['size' => $key]);
             }
         }
         if($request->specifications) {
             foreach ($request->specifications as $key => $value) {
                 //dd($key, $value);
                 $product->specifications()->create([
                     'title_ar' => $value['title_ar'],
                     'title_en' => $value['title_en'],
                     'body_ar' => $value['body_ar'],
                     'body_en' => $value['body_en'],
                 ]);
             }
         }
        if($request->discount){
            $offer_price=$product->price - ($product->price * $request->discount / 100);
            $start_date=now()->format('Y-m-d');
            // dd($start_date);
            //update offer_price
            $product->update(
                [
                    'is_offered'=>1,
                    'offer_price'=>$offer_price,
                    'start_date'=>$start_date,
                    'discount'=>$request->discount,
                    'end_date'=>$request->end_date
                ]);

        }
        return $this->apiResponse(null, trans('app.messages.added_successfully'), 201);

    }//end of store product


    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }

        return $this->apiResponse(new ProductDetailsResource($product), '', 200);
    }//end of show product details


    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }

        if ($request->images) {
            foreach ($request->images as $key) {
                $product->images()->create(['image' => $key]);
            }
        }
        if ($request->colors) {
            foreach ($request->colors as $key=>$value) {
                $product->colors()->updateOrCreate(['id'=>$key],['color'=>$value]);
            }
        }

        if ($request->sizes) {
            foreach ($request->sizes as $key=>$value) {
                $product->sizes()->updateOrCreate(['id'=>$key],['size'=>$value]);
            }
        }
        if ($request->specifications) {
            foreach ($request->specifications as $key => $value) {
                //dd($key, $value);
                $product->specifications()->updateOrCreate(['id'=>$key],[
                    'title_ar' => $value['title_ar'],
                    'title_en' => $value['title_en'],
                    'body_ar' => $value['body_ar'],
                    'body_en' => $value['body_en'],
                ]);
            }
        }
        $product_data = $request->validated();
        if($request->discount) {
            $offer_price = $product->price - ($product->price * $request->discount / 100);
            $start_date = now()->format('Y-m-d');
            // dd($start_date);
            //update offer_price
            $product_data += [
                'is_offered' => 1,
                'offer_price' => $offer_price,
                'start_date' => $start_date,
                'discount' => $request->discount,
                'end_date' => $request->end_date
            ];

        }
        $product->update($product_data);
        return $this->apiResponse(null, trans('app.messages.updated_successfully'), 200);


    }//end of update product


    public function destroy($id)
    {
        $product =Product::find($id);
        if (!$product) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        foreach ($product->images as $image) {
            \File::delete(storage_path('app/public/uploads/' . $image->image));
            $image->delete();
        }
        foreach ($product->colors as $color) {
            $color->delete();
        }
        foreach ($product->sizes as $size) {
            $size->delete();
        }
        foreach ($product->specifications as $specification) {
            $specification->delete();
        }

        \File::delete(storage_path('app/public/uploads/'. $product->main_image));

        $product->delete();
        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    }//end of delete product


    public function deleteImage(Request  $request)
    {
        $image =ProductImage::where('id',$request->id)->first();
        if (!$image) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        \File::delete(storage_path('app/public/uploads/' . $image->image));
        $image->delete();

        return $this->apiResponse(null, trans('app.messages.deleted_successfully'), 200);
    }//end of delete image
    //delete product size
    public function deleteSize(Request  $request)
    {
        $size =ProductSize::where('id',$request->id)->first();
        if (!$size) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        \File::delete(storage_path('app/public/uploads/' . $size->size));
        $size->delete();

        return $this->apiResponse(null, trans('app.messages.deleted_successfully'), 200);
    }//end of delete size
    //delete product color
    public function deleteColor(Request $request)
    {
        $color =ProductColor::where('id',$request->id)->first();
        if (!$color) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $color->delete();

        return $this->apiResponse(null, trans('app.messages.deleted_successfully'), 200);
    }//end of delete color

    public function deleteSpecification(Request  $request)
    {
        $specification =Specification::where('id',$request->id)->first();
        if (!$specification) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $specification->delete();
        return $this->apiResponse(null, trans('app.messages.deleted_successfully'), 200);
    }//end of delete specification

    public function activeProduct(Request  $request){
        $product=Product::find($request->id);
        if(!$product){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);

        }
        $is_active = $request->is_active == 'true' ? true : false;
        $product->update(['is_active' => $is_active]);

        if($product->is_active == 1) {
            return  $this->apiResponse(null,'تم تغير حالة المنتج',200);
        }
        else{
            return  $this->apiResponse(null,trans('تم تغير حالة المنتج'),200);
        }
    }
    public function availableProduct(Request  $request){
        $product=Product::find($request->id);
        if(!$product){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);

        }
        $is_available = $request->is_available == 'true' ? true : false;
        $product->update(['is_available' => $is_available]);

        if($product->is_available == 1) {
            return  $this->apiResponse(null,'تم تغير حالة المنتج',200);
        }
        else{
            return  $this->apiResponse(null,trans('تم تغير حالة المنتج'),200);
        }
    }



}
