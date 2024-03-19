<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Coupon\StoreCouponRequest;
use App\Http\Requests\Dashboard\Coupon\UpdateCouponRequest;
use App\Http\Resources\Dashboard\Coupon\CouponDetailsResource;
use App\Http\Resources\Dashboard\Coupon\CouponIndexResource;
use App\Http\Traits\ApiResponses;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
     use ApiResponses;
    public function index()
    {
        $coupons=Coupon::orderBy('id', 'DESC')->get();
        return $this->apiResponse(CouponIndexResource::collection($coupons),'',200);

    }

    public function store(StoreCouponRequest $request)
    {
        Coupon::create($request->validated()+['code'=>str_random(8)]);
        return $this->apiResponse(null, trans('app.messages.added_successfully'), 201);
    }


    public function show($id)
    {
        $coupon=Coupon::find($id);
        if(!$coupon){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        return $this->apiResponse(new CouponDetailsResource($coupon),'',200);
    }


    public function update(UpdateCouponRequest $request, $id)
    {
        $coupon=Coupon::find($id);
        if(!$coupon){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $coupon->update($request->validated());
        return $this->apiResponse(null,trans('app.messages.updated_successfully'),200);
    }


    public function destroy($id)
    {
        $coupon=Coupon::find($id);
        if(!$coupon){
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $coupon->delete();
        return $this->apiResponse(null,trans('app.messages.deleted_successfully'),200);
    }

}
