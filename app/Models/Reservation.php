<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{

    protected $fillable=['user_id','occasion_id','name','phone','occasion_date'];
    protected $dates=['occasion_date'];

    public function occasion(){
        return $this->belongsTo(Occasion::class,'occasion_id');
    }
}
