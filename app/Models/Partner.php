<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected  $fillable=['title','image'];

    public function getImageOrgAttribute()
    {
        if(isset($this->attributes['image'])&&$this->attributes['image']){
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
