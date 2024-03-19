<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Coupon\CouponCheckRequest;
use App\Http\Resources\API\Cart\CartResource;
use App\Http\Traits\ApiResponses;
use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    use ApiResponses;

     public function checkCoupon(CouponCheckRequest $request){
         $user=auth('api')->user();
         //get coupon
         $coupon=Coupon::where('code',$request->coupon_code)
                         ->first();
         if(!$coupon){
             return $this->apiResponse(null,trans('app.messages.coupon_wrong'),422);
         }
         $now=now();
         $expired_at=Carbon::parse($coupon->expired_at);
         $check_uses=$coupon->users()->where('users.id', auth('api')->id())->count();
        if($check_uses >= $coupon->number_of_use){
            return $this->apiResponse(null,trans('app.messages.coupon_max_uses'),422);
        }
        if($expired_at->lt($now)){
            return $this->apiResponse(null,trans('app.messages.coupon_expired'),422);
         }

         //get userCart
         $product_count = Cart::where('user_id', auth('api')->id())->count();
         $user_cart=Cart::where('user_id',auth('api')->id())->get();
         $sub_total_price = $user_cart->sum('item_product_price');
         $discount_price=($sub_total_price*$coupon->coupon_discount)/100;
         $shipping_price=settings('shipping_price');
         $final_price=$sub_total_price-$discount_price+$shipping_price;
//         return $this->apiResponse(
//             [
//               'sub_total_price' =>$sub_total_price,
//               'discount'=>$discount_price,
//               'shipping_price'=>(double)$shipping_price,
//               'final_price'=>$final_price,
//             ]);
         return CartResource::collection($user_cart)->additional([
             'product_count' => $product_count,
             'sub_total_price' => (double)$sub_total_price,
             'discount'=>$discount_price,
             'shipping_price'=>(double)$shipping_price,
             'final_price'=>$final_price,
             'msg' => '',
             'status' => true
         ]);

     }//end of calculate coupon code if is valid

}
