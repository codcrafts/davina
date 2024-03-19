<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{

    protected $fillable=[
        'user_id','city_id','country_id','address_name',
        'street_one','street_two','zip_code','is_default','company','place_name'
    ];

    //relations
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
}
