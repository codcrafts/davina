<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    protected $fillable=['name_ar','name_en','image'];

    public function getImageOrgAttribute()
    {
        if(isset($this->attributes['image'])&& $this->attributes['image']){
            return asset('storage/uploads').'/'.$this->attributes['image'];
        }else{
            return null;
        }
    }

    public function setImageAttribute($value)
    {
        if ($value){
            $this->attributes['image'] = saveImage($value);
        }
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function subCategories(){
        return $this->hasMany(SubCategory::class,'category_id');
    }


    public function productColors()
    {
        return $this->hasManyThrough(
            ProductColor::class,
            Product::class,
            'category_id',
            'product_id',
            'id',
            'id'
        );
    }
}
