<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Notification\NotificationResource;
use App\Http\Traits\ApiResponses;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use ApiResponses;

    public function getNotifications()
    {
        $notifications=auth('api')->user()->notifications;
        return $this->apiResponse(NotificationResource::collection($notifications));
    }

    public function delete(Request $request){

        auth()->user()->notifications()->where('id', $request->id)->first()->delete();
        return  $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    }
}
