<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\OfflineOrder\OfflineOrderDetailsResource;
use App\Http\Resources\Dashboard\OfflineOrder\OfflineOrderIndexResource;
use App\Http\Traits\ApiResponses;
use App\Models\Order;
use Illuminate\Http\Request;

class OfflineOrderController extends Controller
{

    use ApiResponses;
    public function index()
    {
        $orders=Order::where('type','visitor')->latest()->get();
        return $this->apiResponse(OfflineOrderIndexResource::collection($orders),'',200);
    }

    public function show($id)
    {
        $order=Order::where('type','visitor')->find($id);
            if (!$order) {
                return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
            }

            return  $this->apiResponse(new OfflineOrderDetailsResource($order));

    }




    public function destroy($id)
    {
        $order = Order::where('type','visitor')->find($id);
        if (!$order) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $order->delete();
        return $this->apiResponse(null, trans('app.messages.deleted_successfully'), 200);
    }
}
