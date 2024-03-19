<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Reservation\StoreReservationRequest;
use App\Http\Resources\API\Reservation\ReservationIndexResource;
use App\Http\Traits\ApiResponses;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    use ApiResponses;
   public function store(StoreReservationRequest $request){
       Reservation::create($request->validated());
       return  $this->apiResponse(null,trans('app.messages.order_sent'),201);
   }

   //my reservations
   public function index(){
       $res=Reservation::where('user_id',auth()->id())->latest()->get();
       return $this->apiResponse(ReservationIndexResource::collection($res));
   }

}
