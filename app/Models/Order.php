<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    protected $fillable=[
          'user_id','address_id','coupon_id',
          'color_id','size_id','sub_total_price',
         'shipping_price', 'final_price','payment_method',
         'transaction_id','tax_amount','tax_percentage',
         'price_before_coupon','coupon_amount','user_data',
         'coupon_data','status','type'
        ];


    //relations
         public function user(){
             return $this->belongsTo(User::class,'user_id');
         }

    public function address(){
        return $this->belongsTo(Address::class,'address_id');
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class,'order_id');
    }

}
