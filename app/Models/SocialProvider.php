<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{
    protected $table='social_providers';

    protected $fillable=['user_id','provider_type','access_token'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
