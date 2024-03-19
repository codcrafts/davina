<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['key' => 'dashboard_name', 'value' => 'لوحة تحكم تطبيق shop' ],
            ['key' => 'project_name'  , 'value' => 'تطبيق shop' ],
            ['key' => 'app_lang'      , 'value' => 'ar' ],
            ['key' => 'mobile'        , 'value' => '966547855230' ],
            ['key' => 'email'         , 'value' => 'e-commerce@shop.com' ],
            ['key' => 'facebook_url'  , 'value' => 'https://www.facebook.com/' ],
            ['key' => 'twitter_url'   , 'value' => 'https://twitter.com/' ],
            ['key' => 'youtube_url'   , 'value' => 'https://www.youtube.com/' ],
            ['key' => 'instagram_url' , 'value' => 'https://www.instagram.com/' ],
            ['key' => 'snapchat_url'  , 'value' => 'https://www.instagram.com/' ],
            ['key' => 'whatsapp_phone', 'value' => '96653545230' ],
            ['key' => 'main_video_link' ,'value'=>'https://www.youtube.com/embed/videoseries?list=PL4h9CVQtBK45dIUcHhuAVQfgsIY2WvRWa'],
            ['key' => 'header_image'    ,'value'=>''],
            ['key' => 'header_title'    ,'value'=>''],
            ['key' => 'snap'    ,'value'=>'sas'],
            ['key' => 'lat'    ,'value'=>''],
            ['key' => 'lng'    ,'value'=>''],
            ['key' => 'address'    ,'value'=>''],
            ['key' => 'location'    ,'value'=>''],

            ['key' => 'email_host'      , 'value' => '' ],
            ['key' => 'email_driver'    , 'value' => '' ],
            ['key' => 'email_port'      , 'value' => '' ],
            ['key' => 'email_username'  , 'value' => '' ],
            ['key' => 'email_password'  , 'value' => '' ],
            ['key' => 'email_encrypt'   , 'value' => '' ],
            ['key' => 'email_from_address', 'value' => '' ],
            ['key' => 'email_from_name'   , 'value' => '' ],
            ['key' => 'help_ar'   , 'value' => '' ],
            ['key' => 'help_en'   , 'value' => '' ],
            ['key' => 'shipping_ar'   , 'value' => '' ],
            ['key' => 'shipping_en'   , 'value' => '' ],
            ['key' => 'return_product_ar'   , 'value' => '' ],
            ['key' => 'return_product_en'   , 'value' => '' ],
            ['key' => 'terms_sell_ar'   , 'value' => '' ],
            ['key' => 'terms_sell_en'   , 'value' => '' ],
            ['key' => 'terms_use_ar'   , 'value' => '' ],
            ['key' => 'terms_use_en'   , 'value' => '' ],

//            ['key' => 'fcm_sender_id', 'value' => '' ],
//            ['key' => 'fcm_server_key', 'value' => '' ],

            ['key' => 'sms_type', 'value' => '' ],
            ['key' => 'shipping_price', 'value' => (double) 20 ],

            ['key'=>'about_app_ar','value'=>'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقر'],
            ['key'=>'about_app_en','value'=>'There is a proven fact from a long time ago that the readable content of a page will distract the reader from focusing on the external appearance of the text or the form of the paragraphs on the page he read'],
            ['key' => 'auto_active_client', 'value' => 'false' ], // علشان المستخدمين كلهم يتعملهم actvie على طول
            ['key' => 'google_map_key', 'value' => 'AIzaSyDdCP49XcVxRLuY-4CYtxHXxnqucDvQLE8' ],
            ['key'=>'conditions_terms_ar','value'=>'<ul><li>  هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء.
            </li></ul>'],
            ['key'=>'conditions_terms_en','value'=>'<ul><li> There is a proven fact from a long time ago that the readable content of a page will distract the reader from focusing on the external appearance of the text or the form of the paragraphs on the page he reads.
               </li></ul>'],
            ['key'=>'usage_policy_ar','value'=>'<ul><li>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص .</li></ul>'],
            ['key'=>'usage_policy_en','value'=>'<ul><li>There is a proven fact from a long time ago that the readable content of a page will distract the reader from focusing on the external appearance of the text or the form of the paragraphs on the page he reads.</li></ul>'],
            ['key' => 'copy_write', 'value' => 'جميع الحقوق محفوظة لموقع حقك يهمنا' ],
            ['key'=>'reservation_terms_ar','value'=>'<ul><li>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص .</li></ul>'],
            ['key'=>'reservation_terms_en','value'=>'<ul><li>There is a proven fact from a long time ago that the readable content of a page will distract the reader from focusing on the appearance of the text or the form of the paragraphs on the page he reads.</li></ul>'],
          //  ['key' => 'about_ar', 'value' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء.' ],
            ['key' => 'conditions_terms', 'value' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء.' ],
        ];
        foreach ($data as $single_data){
            App\Models\Setting::create($single_data);

        }
    }
}
