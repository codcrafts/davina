<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Product\ProductIndexResource;
use App\Http\Traits\ApiResponses;
use App\Models\Brands;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ApiResponses;

    public function index()
    {

        $data['admins_count'] = User::whereType('admin')->count();
        $data['users_count'] = User::whereType('client')->count();
        $data['cities_count'] = City::count();
        $data['countries_count'] = Country::count();
        $data['galleries_count'] = Slider::whereType('slider')->count();
        $data['advertisements_count'] = Slider::whereType('ads')->count();
        $data['categories_count'] = Category::count();
        $data['orders_count'] = Order::where('type','registered_user')->count();
        $data['orders_without_register_count'] = Order::where('type','visitor')->count();
        $data['brands_count']=Brands::count();
        $data['pending_orders_count'] = Order::where('status', 'pending')->count();
        $data['accepted_orders_count'] = Order::where('status', 'accepted')->count();
        $data['cancelled_orders_count'] = Order::where('status', 'cancelled ')->count();
        $data['rejected_orders_count'] = Order::where('status', 'rejected')->count();
        $data['inWay_orders_count'] = Order::where('status', 'in_way')->count();
        $data['finished_orders_count'] = Order::where('status', 'finished')->count();
        $data['products_count'] = Product::where('is_offered', 0)->count();
        $data['offers_count'] = Product::where('is_offered', 1)->count();
        $data['Active_users_count'] = User::whereType('client')->where('is_banned', 0)->count();
        $data['inActive_users_count'] = User::whereType('client')->where('is_banned', 1)->count();

        $all_finished_orders = \App\Models\Order::where('status', 'finished')->get();

        $today_all_finished_orders = $all_finished_orders->filter(function ($item) {
            if ($item->created_at >= now()->format('Y-m-d')) {
                return $item;
            }
        });
        $data['today_profits'] = $today_all_finished_orders->sum('final_price');
        $week_all_finished_orders = $all_finished_orders->filter(function ($item) {
            if ($item->created_at->gte(now()->subWeek()->format('Y-m-d'))) {
                return $item;
            }
        });
        $data['weekly_profits'] = $week_all_finished_orders->sum('final_price');

        $month_all_finished_orders = $all_finished_orders->filter(function ($item) {
            if ($item->created_at->gte(now()->subMonth()->format('Y-m-d'))) {
                return $item;
            }
        });
        $data['monthly_profits'] = $month_all_finished_orders->sum('final_price');
        $year_all_finished_orders = $all_finished_orders->filter(function ($item) {
            if ($item->created_at->gte(now()->subYear()->format('Y-m-d'))) {
                return $item;
            }
        });
        $data['annual_profits'] = $year_all_finished_orders->sum('final_price');
        return $this->apiResponse($data, '', 200);
    }


    public function topRated(){
        $products=Product::where('is_active',1)->where('rate','<>',0)->orderBy('rate', 'DESC')->take(5)->get();
        return   $this->apiResponse(ProductIndexResource::collection($products));
    }


    public function topSelling(){
        $products =Product::bestSelling()->take(5)->get();
        return   $this->apiResponse(ProductIndexResource::collection($products));
    }
}
