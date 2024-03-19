<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    protected $fillable = [
        'full_name', 'email', 'password','user_name',
        'phone','type','avatar','country_id','city_id',
        'address','lat','lng','is_verified','is_banned',
        'verification_code','reset_code','company','place_name'
    ];
    public function setPasswordAttribute($value)
    {
        if ($value){
            $this->attributes['password'] = bcrypt($value);
        }
    }
    public function setAvatarAttribute($value)
    {
        if ($value){
            $this->attributes['avatar'] = saveImage($value);
        }
    }

    public function getAvatarImageAttribute()
    {
        if(isset($this->attributes['avatar'])&& $this->attributes['avatar']){
            return asset('storage/uploads').'/'.$this->attributes['avatar'];
        }else{
            return asset('assets/profile.png');
        }
    }
    //relations
    public function socialProviders(){
        return $this->hasMany(SocialProvider::class,'user_id');
    }

    public function favoriteProducts(){
        return $this->belongsToMany(Product::class,'favourites','user_id','product_id')
            ->withTimestamps();
    }

    public function city() {

        return $this->belongsTo(City::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class,'user_id');
    }

    public function addresses(){
        return $this->hasMany(Address::class,'user_id');
    }

    public function coupons(){
        return $this->belongsToMany(Coupon::class,'coupon_users','user_id','coupon_id')
            ->withPivot('order_id')
            ->withTimestamps();
    }
    public function devices(){
        return $this->hasMany(UserDevice::class,'user_id');
    }
    public function searches(){
        return $this->hasMany(Search::class,'user_id');
    }
    public function orders(){
        return $this->hasMany(Order::class,'user_id');
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
