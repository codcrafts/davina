<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Order\TrackOrderRequest;
use App\Http\Traits\ApiResponses;
use App\Mail\TrackOrder;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TrackOrderController extends Controller
{
    use ApiResponses;

    public function store(TrackOrderRequest $request){
        $user=User::where('email',$request->email)->first();
        $order=Order::where('user_id',$user->id)
                      ->where('id',$request->order_id)->first();
        if (!$order) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }

        Mail::send(new TrackOrder($order,$order->user->email));
        return  $this->apiResponse(null,'تم الإرسال بنجاح');




    }
}
