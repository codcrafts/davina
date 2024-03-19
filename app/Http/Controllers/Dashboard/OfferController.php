<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Offer\CancelOfferRequest;
use App\Http\Requests\Dashboard\Offer\OfferRequest;
use App\Http\Requests\Dashboard\Offer\StoreMulipleOffers;
use App\Http\Requests\Dashboard\Offer\StoreMulipleOffersRequest;
use App\Http\Resources\Dashboard\Offers\OfferIndexResource;
use App\Http\Traits\ApiResponses;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    use ApiResponses;

        public function createOffer(OfferRequest $request){
            //find product
            // dd($request->validated());
            $product=Product::where('id',$request->product_id)->first();
            $offer_price=$product->price - ($product->price * $request->discount / 100);
            $start_date=now()->format('Y-m-d');
            // dd($start_date);
            //update offer_price
            $product->update(
                [
                    'is_offered'=>1,
                    'offer_price'=>$offer_price,
                    'start_date'=>$start_date,
                    'discount'=>$request->discount,
                    'end_date'=>$request->end_date
                ]);
            return $this->apiResponse(null, trans('app.messages.added_successfully'), 201);

    }//end of create offer

    //cancel offer
    public function cancelOffer(CancelOfferRequest $request){
        $product=Product::where('id',$request->product_id)
                         ->where('is_offered',1)
            ->first();
          $product->update([
            'is_offered'=>0,
            'offer_price'=>null,
            'start_date'=>null,
            'discount'=>null,
            'end_date'=>null
        ]);
        return $this->apiResponse(null, trans('app.messages.offer_cancel'), 200);
    }

     //valid offers
    public function availableOffers(){
            $offers=Product::available()->where('is_offered',1)->get();
            return $this->apiResponse(OfferIndexResource::collection($offers),'',200);
    }

  //expired offers
    public function  unAvailableOffers(){
        $offers=Product::where('is_offered',1)->where('end_date','<',now())->get();
        return $this->apiResponse(OfferIndexResource::collection($offers),'',200);
    }

    public function createManyOffers(StoreMulipleOffersRequest $request){
        $ids = $request->ids;
        $products=Product::whereIn('id',$ids)->get();
        foreach ($products as $product){
            $offer_price = $product->price - ($product->price * $request->discount / 100);
            $start_date = now()->format('Y-m-d');
            // dd($start_date);
            //update offer_price
            $product->update(
                [
                    'is_offered' => 1,
                    'offer_price' => $offer_price,
                    'start_date' => $start_date,
                    'discount' => $request->discount,
                    'end_date' => $request->end_date
                ]);
        }
        return $this->apiResponse(null, trans('app.messages.added_successfully'), 201);





    }










}
