<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Cart\StoreCartRequest;
use App\Http\Requests\API\Cart\UpdateCartRequest;
use App\Http\Resources\API\Cart\CartResource;
use App\Http\Traits\ApiResponses;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use ApiResponses;


    //my cart
    public function index()
    {

        $cart_items = Cart::where('user_id', auth('api')->id())->get();
        $sub_total_price = $cart_items->sum('item_product_price');
        $product_count = Cart::where('user_id', auth('api')->id())->count();
        $shipping_price=settings('shipping_price');
        $discount=0;
        $final_price=$sub_total_price+$shipping_price -$discount;

        return CartResource::collection($cart_items)->additional([
            'product_count' => $product_count,
            'sub_total_price' => (double)$sub_total_price,
            'discount'=>$discount,
            'shipping_price'=>(double)$shipping_price,
            'final_price'=>$final_price,
            'msg' => '', 'status' => true
        ]);

    }//end my cart


    //add to cart
    public function store(StoreCartRequest $request)
    {
        $cart = Cart::where('user_id', auth('api')->id())->first();

        $checkProduct=Cart::where('user_id', auth('api')->id())->where(['product_id' => $request->product_id,
        'color_id' => $request->color_id, 'size_id' => $request->size_id])->first();

        if($checkProduct){
            return $this->apiResponse(null,trans('app.messages.product_added_before_cart'),200);
        }
        $product = Product::where('id', $request->product_id)->first();

        if($product->is_offered==0){
            $total_price = $product->price * $request->quantity;
        }else{
            $total_price = $product->offer_price * $request->quantity;
        }

        Cart::updateOrCreate(['product_id' => $request->product_id, 'user_id' => auth('api')->id()], [
                 'color_id'=>$request->color_id,
                 'size_id'=>$request->size_id,
                 'quantity' => $request->quantity,
                 'total_price' => $total_price
            ]);
        return $this->apiResponse(null, trans('app.messages.added_successfully'), 201);


    }//end add to cart


   //update my cart
    public function update( UpdateCartRequest $request, $id)
    {
        $cart=Cart::where('user_id',auth('api')->id())->find($id);
        if(!$cart){
            return $this->apiResponse(null,trans('app.exceptions.no_record_found'),422);
        }
        $product =$cart->product;
        if($product->is_offered==0){
            $total_price = $product->price * $request->quantity;
        }else{
            $total_price = $product->offer_price * $request->quantity;
        }
        $cart->update($request->validated()+['total_price'=>$total_price]);

        $cart_items = Cart::where('user_id', auth('api')->id())->get();
        $sub_total_price = $cart_items->sum('item_product_price');
        $product_count = Cart::where('user_id', auth('api')->id())->count();
        $shipping_price=settings('shipping_price');
        $discount=0;
        $final_price=$sub_total_price+$shipping_price -$discount;
        return CartResource::collection($cart_items)->additional([
            'product_count' => $product_count,
            'sub_total_price' => (double)$sub_total_price,
            'discount'=>$discount,
            'shipping_price'=>(double)$shipping_price,
            'final_price'=>$final_price,
            'msg' => '',
            'status' => true
        ]);















    }//end update my cart

  //delete my cart
    public function destroy($id)
    {
        $cart=Cart::where('user_id',auth('api')->id())->find($id);
        if(!$cart){
            return $this->apiResponse(null,trans('app.exceptions.no_record_found'),422);
        }
        $cart->delete();
        $cart_items = Cart::where('user_id', auth('api')->id())->get();
        $sub_total_price = $cart_items->sum('item_product_price');
        $product_count = Cart::where('user_id', auth('api')->id())->count();
        $shipping_price=settings('shipping_price');
        $discount=0;
        $final_price=$sub_total_price+$shipping_price -$discount;
        return CartResource::collection($cart_items)->additional([
            'product_count' => $product_count,
            'sub_total_price' => (double)$sub_total_price,
            'discount'=>$discount,
            'shipping_price'=>(double)$shipping_price,
            'final_price'=>$final_price,
            'msg' => '',
            'status' => true
        ]);



    }//end of delete
}
