<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Order\StoreOrderRequest;
use App\Http\Traits\ApiResponses;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Notifications\ReceivedNotify;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponses;

    public function store(StoreOrderRequest $request)
    {

        $order = Order::create(array_except($request->validated() ,['coupon_code'])+
                 [
                     'user_id' => auth('api')->id(),
                      'status' => 'pending',
                      'type'=>'registered_user'
                 ]);
        $cart_items = Cart::where('user_id', auth('api')->id())->get();

        $total_price = 0;
        foreach ($cart_items as $cart_item) {
            // calculate product price
            $product = Product::find($cart_item->product_id);

            if ($product->is_offered == 0) {
                $price = $product->price;
            } else {
                $price = $product->offer_price;
            }
            $order_item = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart_item->product_id,
                'color_id' => $cart_item->color_id,
                'is_offered' => $cart_item->is_offered,
                'size_id' => $cart_item->size_id,
                'product_price' => $price,
                'quantity' => $cart_item->quantity,
                'total_price' => $price * $cart_item->quantity,
                'product_data' => json_encode($product),
            ]);
            $sub_total_price = $price * $cart_item->quantity;


        }

        if ($request->coupon_code) {
            //get coupon
            $coupon = Coupon::where('code', $request->coupon_code)->first();
            if (!$coupon) {
                return $this->apiResponse(null, trans('app.messages.coupon_wrong'), 422);
            }
            $now = now();
            $expired_at = Carbon::parse($coupon->expired_at);
            $check_uses = $coupon->users()->where('users.id', auth('api')->id())->count();
            if ($check_uses >= $coupon->number_of_use) {
                return $this->apiResponse(null, trans('app.messages.coupon_max_uses'), 422);
            }

            if ($expired_at->lt($now)) {
                return $this->apiResponse(null, trans('app.messages.coupon_expired'), 422);
            }
            $sub_total_price = $cart_items->sum('item_product_price');
            $discount_price = ($sub_total_price * $coupon->coupon_discount) / 100;
            $shipping_price = settings('shipping_price');
            $final_price = $sub_total_price - $discount_price + $shipping_price;

            $order->update([
                'sub_total_price' => $sub_total_price,
                'shipping_price' => $shipping_price,
                'final_price' => $final_price,
                'coupon_id' => $coupon->id,
                'coupon_amount' => $discount_price,
                'user_data' => json_encode(auth('api')->user()),
                'coupon_data' => json_encode($coupon),
            ]);
            $coupon->users()->attach(auth('api')->id(),['order_id' => $order->id]);
        }

        else {
                $sub_total_price = $price * $cart_item->quantity;
                $shipping_price = settings('shipping_price');
                $final_price = $sub_total_price + $shipping_price;

                $order->update([
                    'sub_total_price' => $sub_total_price,
                    'shipping_price' => $shipping_price,
                    'final_price' => $final_price,
                    'user_data' => json_encode(auth('api')->user()),
                ]);
            }
        //delete cart
        $cart_items=Cart::where('user_id',auth('api')->id())->delete();

        //send notify

        $data=[
            'title'=>trans('app.notification.order.title.new'),
            'body'=>trans('app.notification.order.body.client_new',['client_name'=>auth('api')->user()->full_name]),
            'type'=>'order',
            'status'=>$order->status,
            'data_id'=>$order->id,
            'created_at'=>$order->created_at->format('d/m/Y')
        ];
        $admins = User::whereType('admin')->get();
        \Notification::send($admins,new ReceivedNotify($data));
        return  $this->apiResponse(null,trans('app.messages.order_sent'),201);


        }//end of create order
    }





















