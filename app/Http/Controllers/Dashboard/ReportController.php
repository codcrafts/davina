<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Filter\ReportFilterRequest;
use App\Http\Resources\Dashboard\Order\OrderIndexResource;
use App\Http\Traits\ApiResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    use ApiResponses;

    public function orderProfits(){

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
        return $this->apiResponse($data,'',200);
    }



    public function filterProfits(ReportFilterRequest $request){
        $orders = \App\Models\Order::where('status', 'finished')
            ->when($request->type=='day',function ($q) {

                $q->whereDate('created_at', Carbon::today());
            })
            ->when($request->type=='week',function ($q) {

                $date = \Carbon\Carbon::today()->subWeek();
                $q->whereDate('created_at','>=',$date);
            })
            ->when($request->type=='month',function ($q) {

                $date = \Carbon\Carbon::today()->subMonth();
                $q->whereDate('created_at','>=',$date);
            })
            ->when($request->type=='year',function ($q) {
                $date = \Carbon\Carbon::today()->subYear();
                $q->whereDate('created_at','>=',$date);
            })
            ->when($request->type=='arrange_date',function ($q) use ($request) {
                $from_date=Carbon::parse($request->from_date);
                $to_date=Carbon::parse($request->to_date);
                $q->whereBetween('created_at', [$from_date,$to_date ]);
            })
            ->get();
              $p=$orders->sum('final_price');
        return OrderIndexResource::collection($orders)->additional(['total_profits'=>$p,'msg'=>'','status'=>true]);

    }



}
