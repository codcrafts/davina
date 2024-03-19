<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Order\OrderDetailsResource;
use App\Http\Resources\API\Order\OrderIndexResource;
use App\Http\Traits\ApiResponses;
use App\Models\Order;
use App\Models\User;
use App\Notifications\ReceivedNotify;
use Illuminate\Http\Request;

class ClientOrderController extends Controller
{
    use  ApiResponses;
    //cancel order
    public function cancelOrder(Request $request)
    {

        $order = Order::where('user_id', auth('api')->id())->where('status', 'pending')->find($request->id);
        if (!$order) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }

        $order->update(['status' => 'cancelled']);
        //send notify
        $data = [
            'title' => trans('app.notification.order.title.cancelled'),
            'body' => trans('app.notification.order.body.client_cancelled', ['client_name' => auth('api')->user()->full_name]),
            'type' => 'order',
            'status' => $order->status,
            'data_id' => $order->id,
            'created_at' => now()->format('d/m/Y')
        ];

        $admins = User::whereType('admin')->get();
        \Notification::send($admins, new ReceivedNotify($data));
        return $this->apiResponse(null, trans('app.messages.order_cancelled'), 200);

    }//end of cancel order

    //finish order
    public function finishOrder(Request $request)
    {
        $order = Order::where('user_id', auth('api')->id())->where('status', 'in_way')->find($request->id);
        if (!$order) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }

        $order->update(['status' => 'finished']);
        //send notify
        $data = [
            'title' => trans('app.notification.order.title.finished'),
            'body' => trans('app.notification.order.body.client_finished', ['client_name' => auth('api')->user()->full_name]),
            'type' => 'order',
            'status' => $order->status,
            'data_id' => $order->id,
            'created_at' => now()->format('d/m/Y')
        ];
        $admins = User::whereType('admin')->get();
        \Notification::send($admins, new ReceivedNotify($data));
        return $this->apiResponse(null, trans('app.messages.order_finished'), 200);

    }//end of finish order

    public function index(){

     $orders=Order::where('user_id',auth('api')->id())->orderBy('id', 'DESC')->get();
       return $this->apiResponse(OrderIndexResource::collection($orders),'',200);
    }//end of all products


    public function show($id){
        $order = Order::where('user_id', auth('api')->id())->find($id);
        if (!$order) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        return  $this->apiResponse(new OrderDetailsResource($order),'',200);


    }
}
