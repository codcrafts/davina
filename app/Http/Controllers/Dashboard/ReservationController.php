<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Reservation\ReservationIndexResource;
use App\Http\Traits\ApiResponses;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    use ApiResponses;
    public function index(){
        $res=Reservation::latest()->get();
        return $this->apiResponse(ReservationIndexResource::collection($res));
    }
}
