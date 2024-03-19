<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{

    protected $fillable=['user_id','product_id','color_id','size_id',
        'quantity','total_price'
    ];
    //relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
//    public function getItemPriceAttribute()
//    {
//        $price = 0;
//        $price = ($this->product->price) * $this->quantity;
//        return $price;
//    }

    public function getItemProductPriceAttribute()
    {
        $price = 0;
        $price = ($this->product->offer_price ?? $this->product->price) * $this->quantity;
        return $price;
    }
    public function color(){
        return $this->belongsTo(ProductColor::class,'color_id');
    }
    public function size(){
        return $this->belongsTo(ProductSize::class,'size_id');
    }
}
