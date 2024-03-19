<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    protected $fillable=['user_id','product_id','rate','comment'];


    //creator
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    //rateable
    public function  product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
