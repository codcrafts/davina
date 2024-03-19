<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specification extends Model
{

    protected $fillable=['product_id','title_ar','title_en','body_ar','body_en'];

    //relations

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

}
