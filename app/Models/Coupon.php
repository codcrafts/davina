<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    protected  $fillable=['code','expired_at','coupon_discount','number_of_use'];



    public function users(){
        return $this->belongsToMany(User::class,'coupon_users','coupon_id','user_id')
                       ->withPivot('order_id')
                      ->withTimestamps();
    }
   // protected $dates = ['expired_at'];
//    protected $casts=[
//        'expired_at'=>'d/m/Y'];
}
