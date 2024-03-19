<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Language Lines
    |--------------------------------------------------------------------------
 */

    'auth' => [
        'wrong_code' => 'The input code is wrong',
        'user_not_found' => 'this user not found on system',
        'reset_code_success'=>'The entered code has been verified successfully. You can change the password now',
        'account_not_verified'=>'please activate your account',
        'verified_before'=>'this account has been verified before',


    ],

    'required' => [
        'code_required' => 'the activation code is required',
        'mobile_required' => 'mobile is required',
        'name_required' => 'name is required',
        'new_password_required' => 'new password is required',
        'device_type_required' => 'device type is required',
    ],

    'country' => [
        'country_not_found' => 'this country not found on system',
    ],
    'city' => [
        'city_not_found' => 'this city not found on system',
        'street_not_found' => 'this street not found on system',

    ],

    'client' => [
        'client_id_required' => 'client_id is required',
        'client_not_found' => 'this client not found on system',
    ],

    'product' => [
        'product_not_found' => 'this product not found on system',
    ],

    'driver' => [
        'driver_id_required' => 'driver_id is required',
        'driver_not_found' => 'this driver not found on system',
        'you_have_not_entered_the_vehicle_data' => 'You have not entered the vehicle data',
    ],

    'shipping_card' => [
        'card_has_expired' => 'This card has expired',
        'card_used_before' => 'The card is already used',
        'you_have_already_used_the_card' => 'You\'ve already used the card',
    ],

    'contact' => [
        'name_required' => 'name is requried',
        'mobile_required' => 'mobile is requried',
        'email_required' => 'email is requried',
    ],

    // order
    'order' => [
        'order_id_required' => 'order_id is required',
        'order_not_found' => 'this order not found on system',
    ],

    // notification
    'notification' => [
        'notification_id_required' => 'notification_id required',
        'notification_not_found' => 'this notification not found on system',
        'order'=>[
            'title'=>[
                'new'=>'New Order ',
                'accepted'=>'Accepted Order ',
                'finished'=>'Finished Order',
                'rejected'=>'Rejected Order ',
                'cancelled'=>'Cancelled Order ',
                'approved'=>'طلب تسجيل',
                'in_way'=>'In way Order',
                'selected_store'=>'اختيار متجر',
                'selected_driver'=>'اختيار سائق',
                'send_offer'=>'عرض سعر',
                'provider_confirm'=>'استلام المندوب'
            ],
            'body'=>[
                 'client_new'=>'client :client_name  has created a new Order',
                 'client_finished'=>'client :client_name  has finished the order',
                 'client_cancelled'=>'client :client_name  has cancelled the order',

                    'provider_accepted'=>'Your Order has been accepted by the administration',
                    'provider_in_way'=>' Yor order in way ',
                 //   'provider_in_way'=>'قام :provider_name  بتجهيز الطلب وتوصيله',
                    'provider_rejected'=>'Your Order has been rejected by the administration',
                 //   'admin_approved'=>'تمت الموافقة علي طلب التسجيل من قبل الادارة'


            ],
    ],
        'rate'=>[
            'title'=>'New rate',
            'body'=>'Client :client_name has rated you',
        ],

    ],

    // FCM
    'fcm' => [
        // 'title' => 'Zayed App',
        'title' => 'App',
        'new_chat_message' => 'New Message',
    ],

    'exceptions' => [
        'jwt' => [
            'token_expired_exception' => 'Token has expired',
            'token_invalid_exception' => 'Token is invalid',
            'jwt_exception' => 'Token is absent',
            'token_unauthorized' => 'Token Unauthorized',
        ],
        'not_found_exception' => 'Something went wrong, Please contact the administrator',
    ],

    'messages' => [
        'please_complete_the_data' => 'Please complete the data',
        'success_login' => ' Signin Successfully',
        'send_reply'=>'Reply has been sent successfully   ',
        'failed_login' => ' Login Failed',
        'password_changed'=>'The password has been modified successfully',

        'not_approved_message' => 'The Management has not confirmed your data yet',
        'banned_message' => 'Your Account Has Banned By Managment',
        'deactivation_message' => 'Your Mobile Not Activated Yet',
        'success_register' => 'User Registered Successfully',
        'admin_approved'=>'The registration request has been sent successfully pending the approval of the administration',

        'success_logout' => ' Signout Successfully',
        'added_successfully' => 'Added Successfully',
        'updated_successfully' => 'Updated Successfully',
        'deleted_successfully' => 'Deleted Successfully',
        'activated_successfully' => 'Activated Successfully',
        'sent_successfully' => 'Sent Successfully',
        'sent_your_reply_successfully' => 'Your reply has been sent successfully',
        'sent_code_successfully' => 'Sent Code Successfully',
        'not_allowed_to_modify' => 'You are not allowed to modify the data',
        'not_allowed_to_delete' => 'You are not allowed to delete the data',
        'something_went_wrong_please_try_again' => 'Something went wrong. Please try again',
        'banned_account' => 'Banned Account',
        'deactivated_account' => 'Deactivated Account',
        'password_not_match' => 'The password does not match',
        'code_message' => 'Your activation code is ',
        'charged_successfully' => 'Your credit has been successfully charged',
        'wrong_code_please_try_again' => 'The verification code is wrong. Please check the verification code',
        'you_are_already_active' => 'already activated',
        'you_must_be_in_the_country_where_the_account_was_registered' => 'You must be in the country where the account is registered',
        'u_do_not_stores'=>'You Do not have store or bazer in the system',
          'sell_order_create'=>'Order created successfully,waiting Administration approval',
        'maintenance_order_create'=>'Maintenance order has been sent successfully awaiting price offers',
        'in_active_user'=>'Your account has been deactivated by the administration ',
        'active_user'=>'Your account has been ctivated by the administration ',
        'order_sent'=>'Order has been sent',
        'order_cancelled'=>'Order has been cancelled ',
        'order_finished'=>' Order has been finished',
        'order_rejected'=>'Order has been rejected',
        'order_accepted'=>'Order has been accepted',
        'order_in_way'=>'Order in way',
        'rated_successfully'=>'Rating has been done successfully',
        'same_provider_cart'=>'Please choose the same store in cart ',
        'product_added_before_cart'=>'same product has been added before in cart',
        'package_subscribe'=>'Subscription has done successfully',

        'offer_cancel'=>'Offer has been ended in this product',
        'addFav'=>'Added to favorites list',
        'removeFav'=>'Removed to favorites list',
        'coupon_expired'=>'The discount code has expired',
        'coupon_wrong'=>'The discount code is incorrect',
        'coupon_max_uses'=>'The discount code has expired',
        'subscribed_before'=>'You subscribed before'


    ],
    'package' => [
        'free'=>'Free',
        'package' => 'Package',
        'packages' => 'packages',
        'package_data' => 'Package data',
        'name' => 'Package Name',
        'period' => 'package period',
        'period_type' => 'Package period type',
        'price' => 'package price',
        'subscription_start_date' => 'Start date',
        'subscription_end_date' => 'end date',
        'period_types' => [
            'hours' => 'hours',
            'days' => 'days',
            'weeks' => 'weeks',
            'months' => 'months',
            'years' => 'years',
        ],
        'plan' => 'Package powers',
        'plans' => [
            'store_name' => 'store name', // true or false
            'store_logo' => 'Store Logo', // true or false
            'product_count' => 'number of products :attribute product', // number of products allowed to be uploaded
            'mobiles' => 'Communication numbers :attribute number', // The number of numbers he can add
            'whatsapp_mobiles' => 'WhatsApp contact numbers :attribute number', // The number of WhatsApp numbers he can add
            'email' => 'Emails :attribute email', // The number of emails he can add
            'chating' => 'messaging', // true or false
            'store_desc' => 'Store description :attribute character', // number of characters allowed in the description
            'cover_store_page' => 'Store Background Image', // true or false
            'staffing' => 'store hiring', // true or false
            'working_hours' => 'Opening Hours', // true or false
            'social_media' => 'Shop social media', // true or false
            'location_on_map' => 'Store location on map', // true or false
            'store_color' => 'Change store color', // true or false
            'boarder_color' => 'Change store window color', // true or false
            'priority_to_show_store_on_map' => 'Store preference on map', // true or false
            ],
        ],
    'store'=>[
        'store' => 'store :attribute',
        'is_found'=>'No store has selected yet'
    ],
    'administration'=>'administration'
];
