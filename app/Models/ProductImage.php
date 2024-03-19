<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{

    protected $fillable=['product_id','image'];

    public function getImageOrgAttribute()
    {
        if(isset($this->attributes['image'])&&$this->attributes['image']){
            return asset('storage/uploads').'/'.$this->attributes['image'];
        }else{
            return asset('assets/product.jpeg');
        }
    }

    public function setImageAttribute($value)
    {
        if ($value){
            $this->attributes['image'] = saveImage($value);
        }
    }
}
