<?php

namespace App\Http\Resources\API\Home;

use App\Http\Resources\API\Adertisement\AdvertisementResource;
use App\Http\Resources\API\Category\CategoryResource;
use App\Http\Resources\API\Gallery\GalleryResource;
use App\Http\Resources\API\News\NewsResource;
use App\Http\Resources\API\Product\ProductResource;
use App\Http\Resources\API\Testimonials\TestimonialsResource;
use App\Http\Resources\Dashboard\Partner\PartnerIndexResource;
use App\Models\Category;
use App\Models\News;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Testimonial;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{

    public function toArray($request)
    {
        return [

           'galleries'=>GalleryResource::collection(Slider::whereType('slider')->latest()->get()),
           'categories_with_image'=>CategoryResource::collection(Category::whereNotNull('image')->whereHas('products')->latest()->take(4)->get()),
            'best_selling'=>ProductResource::collection(Product::where('is_active',1)->bestSelling()->latest()->take(4)->get()),
            'categories_no_image'=>CategoryResource::collection(Category::whereNull('image')->whereHas('products')->with('subCategories')->latest()->take(5)->get()),
            'recommended_products'=>ProductResource::collection(Product::where('is_active',1)->latest()->take(4)->get()),
           // 'latest_products'=>ProductResource::collection(Product::where('is_active',1)->latest()->take(4)->get()),
            'advertisements'=>AdvertisementResource::collection(Slider::whereType('ads')->latest()->get()),
            'top_rated'=>ProductResource::collection(Product::where('is_active',1)->where('rate','<>',0)->latest()->take(4)->get()),
            'partners'=>PartnerIndexResource::collection(Partner::latest()->get()),
            'our_client_say'=>TestimonialsResource::collection(Testimonial::latest()->get()),
            'latest_news'=>NewsResource::collection(News::latest()->take(4)->get())
        ];
    }
}
