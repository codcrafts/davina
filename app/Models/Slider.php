<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable=['type','title_ar','title_en','link','image'];

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
