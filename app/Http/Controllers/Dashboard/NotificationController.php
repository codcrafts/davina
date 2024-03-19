<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Notification\SendSingleNotifyRequest;
use App\Http\Requests\Dashboard\Notification\StoreNotificationRequest;
use App\Http\Resources\API\Notification\NotificationResource;
use App\Http\Traits\ApiResponses;
use App\Models\User;
use App\Notifications\ReceivedNotify;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use  ApiResponses;

    public function getNotifications()
    {
        $notifications=auth('api')->user()->notifications;
        return $this->apiResponse(NotificationResource::collection($notifications));
    }

    public function delete(Request $request){
        auth()->user()->notifications()->where('id', $request->id)->first()->delete();
        return  $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    }

    public function sendNotifications(StoreNotificationRequest $request){
        $data=[

            'title'=>$request->title,
            'body'=>$request->body,
            'type'=>'management',
            'data_id'=>0,
            'status'=>'',
            'created_at'=>now()->format('d/m/Y')
        ];
        \Notification::send(User::where('type','<>','admin')->get(),new ReceivedNotify($data));

        return $this->apiResponse(null,trans('app.messages.message_sent'),200);
    }


    //send notification to one user
    public function store(SendSingleNotifyRequest $request){

        $user=User::where('id',$request->user_id)->first();

        if(!$user){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);

        }

        $data=[
            'title'=>$request->title,
            'body'=>$request->body,
            'type'=>'management',
            'data_id'=>0,
            'status'=>'',
            'created_at'=>now()->format('d/m/Y')
        ];
        \Notification::send($user,new ReceivedNotify($data));
        return $this->apiResponse(null,trans('app.messages.message_sent'),200);
    }


}
