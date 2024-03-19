<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Order\OrderDetailsResource;
use App\Http\Resources\Dashboard\Order\OrderIndexResource;
use App\Http\Traits\ApiResponses;
use App\Models\Order;
use App\Notifications\ReceivedNotify;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponses;


    //accept order
    public function acceptOrder(Request $request)
    {
        $order =Order::where('type','registered_user')->where('status','pending')->find($request->id);
        if (!$order) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $order->update(['status' => 'accepted']);
        $user = $order->user;
        //send notify
        $data = [
            'title' => trans('app.notification.order.title.accepted'),
            'body' => trans('app.notification.order.body.provider_accepted'),
            'type' => 'order',
            'status' => $order->status,
            'data_id' => $order->id,
            'created_at' => $order->updated_at->format('d/m/Y')
        ];

        \Notification::send($user, new ReceivedNotify($data));
        return  $this->apiResponse(null, trans('app.messages.order_accepted'), 200);
    }//end of accept order

    //deliver order
    public function deliverOrder(Request $request)
    {
        $order = Order::where('status', 'accepted')->find($request->id);
        if (!$order) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $order->update(['status' => 'in_way']);

        //send notify
        $user = $order->user;
        //send notify
        $data = [
            'title' => trans('app.notification.order.title.in_way'),
            'body' => trans('app.notification.order.body.provider_in_way'),
            'type' => 'order',
            'status' => $order->status,
            'data_id' => $order->id,
            'created_at' => now()->format('d/m/Y')
        ];
        \Notification::send($user, new ReceivedNotify($data));
        return  $this->apiResponse(null,  trans('app.messages.order_in_way'), 200);
    }//end of deliver order

   //reject order
    public function rejectOrder(Request $request)
    {
        $order = Order::where('status', 'pending')->find($request->id);
        if (!$order) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $order->update(['status' => 'rejected']);

        //send notify
        $user = $order->user;
        $data = [
            'title' => trans('app.notification.order.title.rejected'),
            'body' => trans('app.notification.order.body.provider_rejected'),
            'type' => 'order',
            'status' => $order->status,
            'data_id' => $order->id,
            'created_at' => now()->format('d/m/Y')
        ];

        \Notification::send($user, new ReceivedNotify($data));
        return $this->apiResponse(null, trans('app.messages.order_rejected'), 200);
    }//end of reject order


    //order index
    public function index(){
        $orders=Order::where('type','registered_user')->orderBy('id', 'DESC')->get();
        return $this->apiResponse(OrderIndexResource::collection($orders),'',200);
    }//end of index

    public function show($id){
        $order = Order::find($id);
        if (!$order) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }

        return  $this->apiResponse(new OrderDetailsResource($order),'',200);
    }//end of order details

    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $order->delete();
        return $this->apiResponse(null, trans('app.messages.deleted_successfully'), 200);
    }//end of order

    public function pendingOrders(){
          $pendingOrders=Order::where('type','registered_user')->where('status','pending')->orderBy('id', 'DESC')->get();
        return $this->apiResponse(OrderIndexResource::collection($pendingOrders),'',200);

    }//end of pending orders

    public function acceptedOrders(){
        $acceptedOrders=Order::where('type','registered_user')->where('status','accepted')->orderBy('id', 'DESC')->get();
        return $this->apiResponse(OrderIndexResource::collection($acceptedOrders),'',200);

    }//end of accepted orders


    public function finishedOrders(){
        $finishedOrders=Order::where('type','registered_user')->where('status','finished')->orderBy('id', 'DESC')->get();
        return $this->apiResponse(OrderIndexResource::collection($finishedOrders),'',200);

    }//end of finished orders

    public function rejectedOrders(){
        $rejectedOrders=Order::where('type','registered_user')->where('status','rejected')->orderBy('id', 'DESC')->get();
        return $this->apiResponse(OrderIndexResource::collection($rejectedOrders),'',200);

    }//end of finished orders

    public function cancelledOrders(){
        $cancelledOrders=Order::where('type','registered_user')->where('status','cancelled')->orderBy('id', 'DESC')->get();
        return $this->apiResponse(OrderIndexResource::collection($cancelledOrders),'',200);

    }//end of finished orders

    public function inwayOrders(){
        $inwayOrders=Order::where('type','registered_user')->where('status','in_way')->orderBy('id', 'DESC')->get();
        return $this->apiResponse(OrderIndexResource::collection($inwayOrders),'',200);

    }//end of in_way orders

}
