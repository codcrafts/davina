<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponses;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ApiResponses;

    public function index()
    {

        $data = [

            'about_ar' => settings('about_app_ar'),
            'about_en' => settings('about_app_en'),
            'conditions_terms_ar' => settings('conditions_terms_ar'),
            'conditions_terms_en' => settings('conditions_terms_en'),
            'shipping_price' =>(double) settings('shipping_price'),
            'shipping_ar'=>settings('shipping_ar'),
            'shipping_en'=>settings('shipping_en'),
            'return_product_ar'=>settings('return_product_ar'),
            'return_product_en'=>settings('return_product_en'),
            'terms_sell_ar'=>settings('terms_sell_ar'),
            'terms_sell_en'=>settings('terms_sell_en'),
            'terms_use_ar'=>settings('terms_use_ar'),
            'terms_use_en'=>settings('terms_use_en'),
            'usage_policy_ar'=>settings('usage_policy_ar'),
            'usage_policy_en'=>settings('usage_policy_en'),
            'mobile' => settings('mobile'),
            'email' => settings('email'),
            'whatsapp_phone' => settings('whatsapp_phone'),
            'location' => settings('location'),
            'address' => settings('address'),
            'lat' => (double)settings('lat'),
            'lng' =>(double) settings('lng'),
            'facebook_url'=>settings('facebook_url'),
            'twitter_url'=>settings('twitter_url'),
            'youtube_url'=>settings('youtube_url'),
            'instagram_url'=>settings('instagram_url'),
            'note_ar'=>settings('note_ar'),
            'note_en'=>settings('note_en'),
            'shapping_ar'=>settings('shapping_ar'),
            'shapping_en'=>settings('shapping_en'),
            'vat_ar'=>settings('vat_ar'),
            'vat_en'=>settings('vat_en'),


        ];

        return $this->apiResponse($data, '', 200);
    }

    public function update(Request $request)
    {
        if ($request->about_app_ar)
            Setting::where('key', 'about_app_ar')->update(['value' => $request->about_app_ar]);
        if ($request->about_app_en)
            Setting::where('key', 'about_app_en')->update(['value' => $request->about_app_en]);
        if ($request->conditions_terms_ar)
            Setting::where('key', 'conditions_terms_ar')->update(['value' => $request->conditions_terms_ar]);
        if ($request->conditions_terms_en)
            Setting::where('key', 'conditions_terms_en')->update(['value' => $request->conditions_terms_en]);
        if ($request->shipping_price )
            Setting::where('key', 'shipping_price')->update(['value' => $request->shipping_price]);
        if ($request->mobile)
            Setting::where('key', 'mobile')->update(['value' => $request->mobile]);
        if ($request->whatsapp_phone)
            Setting::where('key', 'whatsapp_phone')->update(['value' => $request->whatsapp_phone]);
        if ($request->address)
            Setting::where('key', 'address')->update(['value' => $request->address]);
        if ($request->lat)
            Setting::where('key', 'lat')->update(['value' => $request->lat]);
        if ($request->lng)
            Setting::where('key', 'lng')->update(['value' => $request->lng]);
        if ($request->location)
            Setting::where('key', 'location')->update(['value' => $request->location]);
        if ($request->help_ar)
            Setting::where('key', 'help_ar')->update(['value' => $request->help_ar]);
        if ($request->help_en)
            Setting::where('key', 'help_en')->update(['value' => $request->help_en]);
        if ($request->shipping_ar)
            Setting::where('key', 'shipping_ar')->update(['value' => $request->shipping_ar]);
        if ($request->shipping_en)
            Setting::where('key', 'shipping_en')->update(['value' => $request->shipping_en]);
        if ($request->return_product_ar)
            Setting::where('key', 'return_product_ar')->update(['value' => $request->return_product_ar]);
        if ($request->return_product_en)
            Setting::where('key', 'return_product_en')->update(['value' => $request->return_product_en]);
        if ($request->terms_sell_ar)
            Setting::where('key', 'terms_sell_ar')->update(['value' => $request->terms_sell_ar]);
        if ($request->terms_sell_en)
            Setting::where('key', 'terms_sell_en')->update(['value' => $request->terms_sell_en]);
        if ($request->terms_use_ar)
            Setting::where('key', 'terms_use_ar')->update(['value' => $request->terms_use_ar]);
        if ($request->terms_use_en)
            Setting::where('key', 'terms_use_en')->update(['value' => $request->terms_use_en]);
        if ($request->usage_policy_ar)
            Setting::where('key', 'usage_policy_ar')->update(['value' => $request->usage_policy_ar]);
        if ($request->usage_policy_en)
            Setting::where('key', 'usage_policy_en')->update(['value' => $request->usage_policy_en]);
        if ($request->facebook_url)
            Setting::where('key', 'facebook_url')->update(['value' => $request->facebook_url]);
        if ($request->twitter_url)
            Setting::where('key', 'twitter_url')->update(['value' => $request->twitter_url]);
        if ($request->youtube_url)
            Setting::where('key', 'youtube_url')->update(['value' => $request->youtube_url]);
        if ($request->instagram_url)
            Setting::where('key', 'instagram_url')->update(['value' => $request->instagram_url]);
        if ($request->email)
            Setting::where('key', 'email')->update(['value' => $request->email]);
        if ($request->note_ar)
            Setting::where('key', 'note_ar')->update(['value' => $request->note_ar]);
        if ($request->note_en)
            Setting::where('key', 'note_en')->update(['value' => $request->note_en]);
        if ($request->shapping_ar)
            Setting::where('key', 'shapping_ar')->update(['value' => $request->shapping_ar]);
        if ($request->shapping_en)
            Setting::where('key', 'shapping_en')->update(['value' => $request->shapping_en]);
        if ($request->vat_ar)
            Setting::where('key', 'vat_ar')->update(['value' => $request->vat_ar]);
        if ($request->vat_en)
            Setting::where('key', 'vat_en')->update(['value' => $request->vat_en]);
        return $this->apiResponse(null, trans('app.messages.updated_successfully'), 200);

    }



}
