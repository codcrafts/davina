<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Language Lines
    |--------------------------------------------------------------------------
 */

    'auth' => [
        'wrong_code' => 'الكود المدخل خاطئ',
        'user_not_found' => 'هذا المستخدم غير موجود بالنظام',
        'success_send' => 'تم الارسال بنجاح',
        'fail_send' => 'فشل الارسال',
        'mobile_not_true' => 'رقم الجوال غير صحيح',
        'success_reset_password' => 'تم استعادة كلمة المرور بنجاح قم بتسجيل الدخول الان',
        'success_code' => 'تم التحقق من الكود المدخل بنجاح قم بتسجيل الدخول مرة اخري',
        'mobile_not_true_or_account_not_verified' => 'رقم الجوال غير صحيح او الحساب غير مفعل رجاء التأكد من البيانات المدخلة',
        'reset_code_success'=>'تم التحقق من الكود المدخل بنجاح يمكنك تغير كلمة المرور الان',
        'account_not_verified'=>'الحساب غير مفعل رجاء تفعيل الحساب ',
        'verified_before'=>'الحساب  مفعل من قبل '
    ],

    'required' => [
        'code_required' => 'كود التفعيل مطلوب',
        'mobile_required' => 'رقم الجوال مطلوب',
        'name_required' => 'الاسم مطلوب',
        'new_password_required' => 'كلمة المرور الجديدة مطلوبة',
        'device_type_required' => 'device_type لم تقم بإرسال',
    ],

    'country' => [
        'country_not_found' => 'الدولة غير موجودة بالنظام',
    ],
    'city' => [
        'city_not_found' => 'المدينة غير موجودة بالنظام',
        'street_not_found' => 'الشارع غير موجود بالنظام',

    ],

    'client' => [
        'client_id_required' => 'client_id مطلوب',
        'client_not_found' => 'العميل غير موجود بالنظام',
    ],

    'product' => [
        'product_not_found' => 'المنتج غير موجود بالنظام',
    ],

    'contact' => [
        'name_required' => 'الإسم مطلوب',
        'mobile_required' => 'الرقم مطلوب مطلوب',
        'email_required' => 'البريد الإلكتروني مطلوب مطلوب',
    ],

    // notification
    'news' => [
        'news_not_found' => 'الخبر غير موجود بالنظام',
    ],

    // notification
    'notification' => [
        'notification_id_required' => 'notification_id مطلوب',
        'notification_not_found' => 'الإشعار غير موجود بالنظام',
        'order'=>[
            'title'=>[
                'new'=>'طلب جديد',
                'accepted'=>'طلب مقبول',
                'finished'=>'طلب منتهي',
                'rejected'=>'طلب مرفوض',
                'cancelled'=>'طلب ملغي',
                'approved'=>'طلب تسجيل',
                'in_way'=>'طلب قيد التوصيل ',
                'selected_store'=>'اختيار متجر',
                'selected_driver'=>'اختيار سائق',
                'send_offer'=>'عرض سعر',
                'provider_confirm'=>'استلام المندوب',
                'refund'=>'طلب استرجاع'
            ],
             'body'=>[
                     'client_new'=>'قام العميل :client_name  بانشاء طلب جديد لديك',
                     'client_finished'=>'قام العميل :client_name  بأنهاء الطلب',
                     'client_cancelled'=>'قام العميل :client_name بإلغاء الطلب',
                    'provider_accepted'=>'تمت الموافقة علي طلبك من قبل الادارة',
                    'provider_finished'=>'قام :provider_name  بأنهاء الحجز',
                    'provider_in_way'=>'قامت الأدارة بتجهيز طلبك وجاري التوصيل',
                    'provider_rejected'=>'تم رفض طلبك من قبل الإدارة',
                    'admin_approved'=>'تمت الموافقة علي طلب التسجيل من قبل الادارة',
                    'admin_reply'=>'قامت الادارة باستقبال الطلب وسيتم التواصل معك '

             ],


    ],
        'chat'=>[
            'title'=>[
                'new'=>'رسالة جديدة'
            ],
            'body'=>[
                'message'=>'لديك رسالة جديدة من :sender_name وهي :message',

]


        ],
        'rate'=>[
           'title'=>'تقيم جديد',
           'body'=>'قام  :client_name بتقيمك',
        ],

 ],

    // FCM
    'fcm' => [
        'title' => 'تطبيق',
        'new_chat_message' => 'رسالة جديدة',
    ],

    'exceptions' => [
        'jwt' => [
            'token_expired_exception' => 'انتهت صلاحية الرمز',
            'token_invalid_exception' => 'الرمز غير صالح',
            'jwt_exception' => 'لم تقم بإرسال الرمز',
            'token_unauthorized' => 'رمز غير مصرح به',
        ],
        'not_found_exception' => 'حدث خطأ ما الرجاء التواصل مع الإدارة',
        'no_record_found' => 'لم يتم العثور على بيانات',
    ],

    'messages' => [
        'please_complete_the_data' => 'يرجى إكمال البيانات',
        'send_reply'=>'تم الإرسال بنجاح',
        'password_changed'=>'تم تعديل كلمة المرور بنجاح',
        'message_sent'=>'تم الإرسال بنجاح',
        'password_wrong'=>'كلمة المرور غير صحيحة',
        'success_login' => 'تم تسجيل الدخول بنجاح',
        'failed_login' => 'بيانات تسجيل دخول خاطئة',
        'not_approved_message' => 'لم تقم الإدارة بتأكيد بياناتك بعد',
        'banned_message' => 'تم حظرك من قبل الادارة',
        'deactivation_message' => 'لم تقوم بتفعيل جوالك حتى الان',
        'success_register' => 'تم التسجيل بنجاح ',
        'admin_approved'=>'تم إرسال طلب التسجيل بنجاح بانتظار موافقةالإدارة',
        'success_logout' => 'تم تسجيل الخروج بنجاح',
        'added_successfully' => 'تمت الإضافة بنجاح',
        'updated_successfully' => 'تم التعديل بنجاح',
        'deleted_successfully' => 'تم الحذف بنجاح',
        'activated_successfully' => 'تم التفعيل بنجاح',
        'sent_successfully' => 'تم الارسال بنجاح',
        'sent_code_successfully' => 'تم إرسال الكود بنجاح',
        'not_allowed_to_modify' => 'غير مسموح لك بتعديل البيانات',
        'not_allowed_to_login' => 'غير مسموح لك بالدخول ',
        'not_allowed_to_delete' => 'غير مسموح لك بحذف البيانات',
        'not_allowed_to_view' => 'غير مسموح لك بمشاهدة البيانات',
        'something_went_wrong_please_try_again' => 'حدث خطأ ما. أعد المحاولة من فضلك',
        'banned_account' => 'حساب محظور',
        'deactivated_account' => 'حساب غير مفعل',
        'password_not_match' => 'كلمة المرور غير متطابقة',
        'code_message' => 'كود التحقق الخاص بك هو ',
        'wrong_code_please_try_again'=>'كود التحقق خطأ. من فضلك تأكد من كود التحقق',
        'you_are_already_active'=>'تم التفعيل مسبقا',
        'msg_already_seen_or_you_not_have_chat'=>'تم قراءة الرسالة مسبقا او لايوجد محادثة',
        'msg_seen'=>'تم قراءة الرسالة',
        'you_must_be_in_the_country_where_the_account_was_registered' => 'يجب أن تكون في البلد الذي تم تسجيل الحساب فيها',
        'u_do_not_stores'=>'انت لا تمتلك متجر او بازار في النظام',
        'sell_order_create'=>'تمت الإضافة بنجاح بانتظار موافقة الإدارة',
        'maintenance_order_create'=>'تم إرسال طلب الصيانة بنجاح بانتظار عروض السعر',
        'in_active_user'=>'تم إالغاء تفعيل حسابك من قبل الإدارة',
        'active_user'=>'تم  تفعيل حسابك من قبل الإدارة',
        'order_sent'=>'تم إرسال الطلب',
        'order_cancelled'=>'تم إلغاء الطلب',
        'order_finished'=>'تم إنهاء الطلب',
        'order_rejected'=>'تم رفض الطلب',
        'order_accepted'=>'تم قبول الطلب',
        'order_in_way'=>'جاري توصيل الطلب',
        'rated_successfully'=>'تم التقيم بنجاح',
        'same_provider_cart'=>'الرجاء اختيار نفس المتجر المسجل بالسلة',
        'product_added_before_cart'=>'تمت اضافة المنتج مسبقا',
        'package_subscribe'=>'تم الاشتراك بنجاح',
        'offer_cancel'=>'تم إلغاء العرض من علي هذا المنتج بنجاح',
        'addFav'=>'تمت الأضافة لقائمة المفضلة',
        'removeFav'=>'تم الالغاء من قائمة المفضلة',
        'coupon_expired'=>'إنتهت صلاحية كود الخصم',
        'coupon_wrong'=>'كود الخصم غير صحيح',
        'coupon_max_uses'=>'إنتهت صلاحية كود الخصم',
        'subscribed_before'=>'لقد اشتركت من قبل في النشرة البردية'

    ],
    'package' => [
        'free'=>'مجاني',
        'package' => 'الباقة',
        'packages' => 'الباقات',
        'package_data' => 'بيانات الباقة',
        'name' => 'اسم الباقة',
        'period' => 'فترة الباقة',
        'period_type' => 'نوع فترة الباقة',
        'price' => 'سعر الباقة',
        'subscription_start_date' => ' تاريخ الابتداء',
        'subscription_end_date' => ' تاريخ الانتهاء',
        'period_types' => [
            'hours' => 'الساعات',
            'days' => 'الأيام',
            'weeks' => 'الأسابيع',
            'months' => 'الشهور',
            'years' => 'السنين',
        ],
        'plan' => 'صلاحيات الباقة',
        'plans' => [
            'store_name' => 'اسم المتجر', // true or false
            'store_logo' => 'شعار المتجر', // true or false
            'product_count' => 'عدد المنتجات  :attribute منتج', // عدد المنتجات المسموح رفعها
            'mobiles' => 'عدد ارقام التواصل :attribute رقم',  // عدد الارقام اللي يقدر يضيفهم
            'whatsapp_mobiles' => 'ارقام التواصل للواتساب :attribute رقم',  // عدد الارقام على الواتس اللي يقدر يضيفهم
            'email' => 'عدد البريد الالكتروني :attribute بريد', // عدد الايميلات اللي يقدر يضيفهم
            'chating' => 'المراسلة', // true or false
            'store_desc' => 'وصف المتجر :attribute حرف', // عدد الحروف المسموح بيها في الوصف
            'cover_store_page' => 'صورة خلفية المتجر', // true or false
            'staffing' => 'التوظيف بالمتجر', // true or false
            'working_hours' => 'مواعيد العمل', // true or false
            'social_media' => 'مواقع التواصل الإجتماعي للمتجر', // true or false
            'location_on_map' => 'موقع المتجر على الخريطة', // true or false
            'store_color' => 'تغيير لون المتجر', // true or false
            'boarder_color' => 'تغيير لون الإطار الخاص بالمتجر', // true or false
            'priority_to_show_store_on_map' => 'أفضلية إظهار المتجر على الخريطة', // true or false
        ],
    ],
    'store'=>[
        'store' => 'متجر رقم  :attribute ',
        'is_found'=>'لم يتم تحديد متجر بعد'
    ],
    'administration'=>'الادارة'

];
