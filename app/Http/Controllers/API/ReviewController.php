<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Review\StoreReviewRequest;
use App\Http\Traits\ApiResponses;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use ApiResponses;

    //create review

    public function store(StoreReviewRequest $request ){
        $product = Product::where('id', $request->product_id)->first();
        if (!$product) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }

        $review = auth('api')->user()->reviews()->updateOrCreate([
            'product_id' => $product->id,
            'user_id' => auth('api')->id(),
        ], [
            'comment' => $request->comment,
            'rate' => $request->rate,
        ]);
        $avg = $product->productReviews()->avg('rate');
        $product->rate = $avg;
        $product->save();

//        $data = [
//
//            'title' => trans('app.notification.rate.title'),
//            'body' => trans('app.notification.rate.body', ['client_name' => auth('api')->user()->name]),
//            'type' => 'rate',
//            'image' => auth('api')->user()->avatar_image,
//            'status' => '',
//            'data_id' => $provider->id,
//            'created_at' => $review->created_at->format('d/m/Y')
//        ];
//
//        \Notification::send($provider, new ReceivedNotify($data));
        return $this->apiResponse(null, trans('app.messages.rated_successfully'), 201);

    }
}
