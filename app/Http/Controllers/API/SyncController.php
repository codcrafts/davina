<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CachedData\ProductCachedRequest;
use App\Http\Requests\API\CachedData\SyncCartRequest;
use App\Http\Resources\API\Cart\CartResource;
use App\Http\Resources\API\Favourite\FavouriteResource;
use App\Http\Traits\ApiResponses;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class SyncController extends Controller
{
    use ApiResponses;
    public function syncFavourites(ProductCachedRequest $request){
        $user= auth('api')->user();

        $product_ids = $request->product_ids;

        $user->favoriteProducts()->syncWithoutDetaching($product_ids);

        $products= Product::whereIn('id', $product_ids)->get();

        return $this->apiResponse(FavouriteResource::collection($products));
    }


    public function syncCart(SyncCartRequest $request){
        //$product_ids = request('products');
        $products =request('products') ;
          foreach($products as $productDetails) {
            $colorId = isset($productDetails['color_id']) ? $productDetails['color_id'] : null;
            $sizeId = isset($productDetails['size_id']) ? $productDetails['size_id'] : null;
            $checkProduct = Cart::where('user_id', auth('api')->id())
                ->where([
                    'product_id' => $productDetails['product_id'],
                    'color_id' => $productDetails['color_id'],
                    'size_id' =>  $productDetails['size_id'],
                ])->first();

//            if($checkProduct) {continue;}

              if($checkProduct){
                  return $this->apiResponse(null,trans('app.messages.product_added_before_cart'),200);
              }

            $product = Product::find($productDetails['product_id']);

            if($product->is_offered == 0){
                $total_price = $product->price * $productDetails['quantity'];
            }else{
                $total_price = $product->offer_price * $productDetails['quantity'];
            }

            Cart::updateOrCreate(['product_id' => $productDetails['product_id'], 'user_id' => auth('api')->id()], [
                'color_id' => $colorId,
                'size_id' => $sizeId,
                'quantity' => $productDetails['quantity'],
                'total_price' => $total_price
            ]);
        }
        $cart_items = Cart::where('user_id', auth('api')->id())->get();
        $product_count = $cart_items->count();
        $sub_total_price = $cart_items->sum('item_product_price');
        $shipping_price=settings('shipping_price');
        $discount=0;
        $final_price=$sub_total_price+$shipping_price - $discount;

        return CartResource::collection($cart_items)->additional([
            'product_count' => $product_count,
            'sub_total_price' => (double)$sub_total_price,
            'discount'=>$discount,
            'shipping_price'=>(double)$shipping_price,
            'final_price'=>$final_price,
            'msg' => '',
            'status' => true
        ]);

      //  return $this->apiResponse(null, trans('app.messages.added_successfully'), 201);
    }

}
