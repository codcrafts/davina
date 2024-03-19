<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\CommonQestion\QuestionResoure;
use App\Http\Resources\Dashboard\CommonQuestion\CommonQuestionResource;
use App\Http\Traits\ApiResponses;
use App\Models\CommonQuestion;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    use ApiResponses;
    public function settings(){

        $data=[
            'about'=>settings('about_app_' . app()->getLocale()),
            'conditions_terms'=>settings('conditions_terms_' . app()->getLocale()),
            'common_questions'=>QuestionResoure::collection(CommonQuestion::all()),
            'shipping_price' =>(double) settings('shipping_price'),
            'shipping'=>settings('shipping_' . app()->getLocale()),
            'return_product'=>settings('return_product_'.app()->getLocale()),
            'terms_sell'=>settings('terms_sell_'.app()->getLocale()),
            'terms_use'=>settings('terms_use_'.app()->getLocale()),
            'usage_policy'=>settings('usage_policy_'.app()->getLocale()),
            'shapping'=>settings('shapping_'.app()->getLocale()),
            'vat'=>settings('vat_'.app()->getLocale()),
            'note'=>settings('note_'.app()->getLocale()),
             'contact_us'=>[
                'address'=>settings('address'),
                'lat'=>settings('lat'),
                'lng'=>settings('lng'),
                'phone'=>settings('mobile'),
                'whatsapp'=>settings('whatsapp_phone'),
                'email'=>settings('email'),
                 'facebook_url'=>settings('facebook_url'),
                 'twitter_url'=>settings('twitter_url'),
                 'youtube_url'=>settings('youtube_url'),
                 'instagram_url'=>settings('instagram_url'),
            ],
        ];
        return $this->apiResponse($data,'',200);
    }

    public function questions(){
        $questions=CommonQuestion::get();
        return $this->apiResponse(QuestionResoure::collection($questions),'',200);
    }



}
