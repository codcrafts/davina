<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    protected $fillable = [

        'name_ar', 'name_en', 'description_ar', 'description_en',
        'main_image', 'brand_id', 'sub_category_id','category_id', 'price', 'rate',
        'is_offered', 'is_active', 'offer_price', 'discount', 'start_date', 'end_date','is_available'
    ];

    public function getMainImageOrgAttribute()

    {
        if (isset($this->attributes['main_image']) && $this->attributes['main_image']) {
            return asset('storage/uploads') . '/' . $this->attributes['main_image'];
        } else {
            return asset('assets/product.jpeg');
        }
    }

    public function setMainImageAttribute($value)
    {
        if ($value) {
            $this->attributes['main_image'] = saveImage($value);
        }
    }


    //relations
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class, 'product_id');
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class, 'product_id');
    }

    public function specifications()
    {
        return $this->hasMany(Specification::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brands::class, 'brand_id');
    }

    public function favoriteProductUsers()
    {
        return $this->belongsToMany(User::class, 'favourites', 'product_id', 'user_id')
            ->withTimestamps();
    }

    public function productReviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
    //end of relations

    //scopes
    public function scopeAvailable($query)
    {
        return $query->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now());
    }

    public function scopeBestSelling($query)
    {
        return $query->where('is_active', 1)
            ->join('order_items', 'order_items.product_id', '=', 'products.id')
            ->selectRaw('products.*, SUM(order_items.quantity) AS quantity_sold')
            ->groupBy(['products.id'])
            ->orderByDesc('quantity_sold');
    }
    //end of scopes
    //    // protected $dates = [
    //    //     'start_date',
    //    //     'end_date'
    //    // ];
    // protected $dateFormat='Y-m-d';
//
//    protected $casts=[
//        'start_date'=> 'datetime',
//        'end_date'=>'datetime'
//    ];
    //end of scopes
    // public function setEndDateAttribute($value)
    // {
    //     $this->attributes['end_date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
    // }
}

