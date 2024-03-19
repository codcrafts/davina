<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    protected $fillable=['image','title_ar','title_en','desc_ar','desc_en'];


    public function getImageOrgAttribute()
    {
        if($this->attributes['image']){
            return asset('storage/uploads').'/'.$this->attributes['image'];
        }else{
            return '';
        }
    }

    public function setImageAttribute($value)
    {
        if ($value){
            $this->attributes['image'] = saveImage($value);
        }
    }

}
