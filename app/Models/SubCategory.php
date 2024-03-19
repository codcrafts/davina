<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected  $fillable=['category_id','name_ar','name_en','image'];


    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function getImageOrgAttribute()
    {
        if($this->attributes['image']){
            return asset('storage/uploads').'/'.$this->attributes['image'];
        }else{
            return asset('assets/mtgr.png');
        }
    }

    public function setImageAttribute($value)
    {
        if ($value){
            $this->attributes['image'] = saveImage($value);
        }
    }

}
