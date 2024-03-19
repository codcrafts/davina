<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{

    protected $fillable=['order_id','product_id','quantity',
        'product_price','total_price','product_data','color_id',
        'size_id'
        ];

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function productColor(){
        return $this->belongsTo(ProductColor::class,'color_id');
    }
    public function productSize(){
        return $this->belongsTo(ProductSize::class,'size_id');
    }
}
