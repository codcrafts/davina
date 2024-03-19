<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfflineOrderRegistrationRequest;
use App\Http\Traits\ApiResponses;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderOfflineController extends Controller
{
    use ApiResponses;


        public function store(OfflineOrderRegistrationRequest $request)
        {
            $user = User::create([
                'full_name' => $request['contact']['full_name'],
                'phone' => $request['contact']['phone'],
                'address'=>$request['contact']['address'],
                'company'=>$request['contact']['company'],
                'place_name'=>$request['contact']['place_name'],
                'email' => time() . '@test.com',
                'is_verified' => true,
                'type' => 'visitor',
            ]);

            $address = Address::forceCreate([
                'user_id' => $user->id,
                'address_name' => $user->address,
                'company'=>$user->company,
                'place_name'=>$user->place_name,
            ]);

            $order = Order::create([
                'user_id' => $user->id,
                'address_id' => $address->id,
                'status' => 'visitor_status',
                'type'=>'visitor'
            ]);
            $sub_total_price=0;
            foreach ($request->products as $product) {
                // calculate product price

                $baseProduct = Product::find($product['product_id']);
                if ($baseProduct->is_offered == 0) {
                    $price = $baseProduct->price;
                } else {
                    $price = $baseProduct->offer_price;
                }
                $order_item = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product['product_id'],
                    'color_id' => $product['color_id'],
                    'is_offered' => $baseProduct->is_offered,
                    'size_id' => $product['size_id'],
                    'product_price' => $price,
                    'quantity' => $product['product_quantity'],
                    'total_price' => $price * $product['product_quantity'],
                    'product_data' => json_encode($baseProduct),
                ]);

                $sub_total_price += $price * $product['product_quantity'];



            }//end of foreach
            $shipping_price = settings('shipping_price');
            $final_price = $sub_total_price + $shipping_price;

            $order->update([
                'sub_total_price' => $sub_total_price,
                'shipping_price' => $shipping_price,
                'final_price' => $final_price,
                'user_data' => json_encode($user),
            ]);


            return  $this->apiResponse(null,trans('app.messages.order_sent'),201);
        }


}
