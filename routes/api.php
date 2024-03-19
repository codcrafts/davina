<?php

use Illuminate\Http\Request;

Route::group(['middleware' => ['ApiLang']], function () {

    Route::group(['namespace' => 'API'], function () {
        Route::post('create/reservation','ReservationController@store');

        //auth routes
        Route::group(['prefix' => 'auth'], function () {
            Route::post('register', 'AuthController@register');
            Route::post('social', 'SocialAuthController@socialSign');
            Route::post('email/verify', 'AuthController@verifyEmail');
            Route::post('login', 'AuthController@login');
            Route::post('password/forget', 'AuthController@forgetPassword');
            Route::post('resend-code', 'AuthController@ResendCode');
            Route::post('check/code', 'AuthController@checkResetCode');
            Route::post('password/reset', 'AuthController@resetPassword');
            Route::post('logout', 'AuthController@logout')->middleware('auth:api');
        });

        //general routes for app
        Route::group(['prefix'=>'general'],function (){
            // make order route
          Route::post('order-without-login','OrderOfflineController@store');
            //cities
            Route::get('get-cities/{country_id}', 'CityController@index');
            Route::get('get-countries', 'CountryController@index');
            Route::get('home', 'HomeController@index');
            Route::get('all-best-selling', 'HomeController@topSelling');
            Route::get('recommendedProducts', 'HomeController@recommendedProducts');
            Route::get('AllRecommendedProducts', 'HomeController@AllRecommendedProducts');
            Route::get('all-top-rating', 'HomeController@topRating');
            Route::get('all-offers', 'OfferController@index');
            Route::get('all-categories', 'HomeController@allCategories');
            Route::get('productsByCatID', 'HomeController@productsByCatId');
            Route::get('product-details/{id}', 'HomeController@show');
            Route::get('product-cart-details/{id}', 'HomeController@productCartDetails');
            Route::get('all-products', 'HomeController@allProducts');
            Route::get('all-brands', 'HomeController@getAllBrands');
            Route::get('all-colors', 'HomeController@getAllColors');
            Route::get('occasions', 'HomeController@occasions');
            Route::get('category/{category_id}/subcategories', 'HomeController@sub_categories');
            Route::get('categories_no_image','HomeController@categories_no_image');
            Route::get('categories_with_image','HomeController@categories_with_image');


            //filter and search
            Route::post('filter','FilterController@index');
            Route::post('filter-data','FilterController@filter');
            Route::post('search','SearchController@search');

             //settings
            Route::get('settings','SettingController@settings');
            Route::get('common-questions','SettingController@questions');

            //order track
            Route::post('order-track','TrackOrderController@store');


            Route::post('contact','ContactController@store');
            Route::post('newsletter','HomeController@subscribe_on_news_letter');

        });//end of general


        //auth routes
        Route::group(['middleware'=>['auth:api','ClientMiddleware','BlockedMiddleware']], function () {
            //fovourites

            Route::post('favourite','FavouriteController@addFavourite');
            Route::get('myFavourites','FavouriteController@myFavourites');

            //review route
            Route::post('create/review','ReviewController@store');
            Route::post('store-keywords','SearchController@store');
            Route::get('recent-searches','SearchController@recentSearches');
            Route::delete('delete-searches','SearchController@deleteSearches');

            //client profile
            Route::post('edit-profile','ProfileController@editProfile');
            Route::get('get-profile','ProfileController@getProfile');
            Route::post('change-password', 'ProfileController@changePassword');
            //end of client profile

            //address routes
            Route::post('select/address','AddressController@selectAddress');
            Route::apiResource('addresses','AddressController');

            // cart routes
            Route::apiResource('carts','CartController')->except(['create', 'edit','show']);
            //check coupon
            Route::post('check-coupon','CouponController@checkCoupon');

            //order routes
            Route::post('create-order','OrderController@store');
            Route::post('cancel/order','ClientOrderController@cancelOrder');
            Route::post('finish/order','ClientOrderController@finishOrder');
            Route::get('my/orders','ClientOrderController@index');
            Route::get('order-details/{id}','ClientOrderController@show');

            //reservations

            Route::get('reservations','ReservationController@index');

            //Notifications route
            Route::get('my/notifications', 'NotificationController@getNotifications');
            Route::post('notifications/delete', 'NotificationController@delete');

            //sync data routes
            Route::post('sync-favourites','SyncController@syncFavourites');
            Route::post('sync-cart','SyncController@syncCart');
        });
    });

    //dashboard routes
    Route::group(['namespace' => 'Dashboard'], function () {

        Route::post('dashboard/login', 'AdminController@login');

        Route::group(['prefix' => 'dashboard', 'middleware'=>['auth:api','DashboardMiddleware']], function () {
            //admins route
            Route::apiResource('admins', 'AdminController')->except(['create', 'edit']);
            Route::post('logout', 'AdminController@logout');

            //client routes
            Route::apiResource('clients','ClientController')->except(['create', 'edit']);
            Route::post('delete-all-users','ClientController@deleteAll');

            //countries
            Route::apiResource('countries','CountryController')->except(['create', 'edit']);

            //partners
            Route::apiResource('partners','PartnerController')->except(['create', 'edit']);

            //testimonials
            Route::apiResource('testimonials','TestimonialsController')->except(['create', 'edit']);

            //cities
            Route::apiResource('cities','CityController')->except(['create', 'edit']);

            //brands
            Route::apiResource('brands','BrandController')->except(['create', 'edit']);

            //Sliders route
            Route::apiResource('sliders','SliderController')->except(['create', 'edit']);

            //news route
            Route::apiResource('news','NewsController')->except(['create', 'edit']);

            //Advertisement route
            Route::apiResource('advertisements','AdvertisementController')->except(['create', 'edit']);

            //categories
            Route::apiResource('categories','CategoryController')->except(['create', 'edit']);
            Route::post('delete-cat-image','CategoryController@imageDestroy');
            //sub_categories
            Route::apiResource('sub_categories','SubCategoryController')->except(['create', 'edit']);
            Route::get('category/{category_id}/subcategories', 'SubCategoryController@sub_categories');

            //Occasions
            Route::apiResource('occasions','OccasionController')->except(['create', 'edit']);
            //questions
            Route::apiResource('questions','CommonQuestionController')->except(['create', 'edit']);
            Route::apiResource('roles','RoleController')->except(['create', 'edit']);

            //products
            Route::apiResource('products','ProductController')->except(['create', 'edit']);
            Route::post('product/images','ProductController@deleteImage');
            Route::post('product/colors','ProductController@deleteColor');
            Route::post('product/sizes','ProductController@deleteSize');
            Route::post('product/specifications','ProductController@deleteSpecification');
            Route::post('change/status','ProductController@activeProduct');
            Route::post('is_available','ProductController@availableProduct');

            //offers route
            Route::post('create/offer','OfferController@createOffer');
            Route::post('multiple-offers','OfferController@createManyOffers');
            Route::post('cancel/offer','OfferController@cancelOffer');
            Route::get('available/offers','OfferController@availableOffers');
            Route::get('expired/offers','OfferController@unAvailableOffers');

            //coupons routes
            Route::apiResource('coupons','CouponController')->except(['create', 'edit']);


            //order routes
            Route::post('reject/order','OrderController@rejectOrder');
            Route::post('accept/order','OrderController@acceptOrder');
            Route::post('deliver/order','OrderController@deliverOrder');
            Route::apiResource('orders','OrderController')->only('show','index','destroy');
            Route::get('pending-orders','OrderController@pendingOrders');
            Route::get('accepted-orders','OrderController@acceptedOrders');
            Route::get('rejected-orders','OrderController@rejectedOrders');
            Route::get('cancelled-orders','OrderController@cancelledOrders');
            Route::get('inway-orders','OrderController@inwayOrders');
            Route::get('finished-orders','OrderController@finishedOrders');


            //Notifications route
            Route::get('notifications', 'NotificationController@getNotifications');
            Route::post('notifications/delete', 'NotificationController@delete');
            Route::post('send/notifications', 'NotificationController@sendNotifications');
            Route::post('single/notify', 'NotificationController@store');

            //active user

            Route::post('active/user/{id}','ActiveUserController@update');
            Route::get('active/users','ActiveUserController@activeUsers');
            Route::get('inactive/users','ActiveUserController@inActiveUsers');

            //home page routes
            Route::get('home','HomeController@index');
            Route::get('top-rated','HomeController@topRated');
            Route::get('top-selling','HomeController@topSelling');
           //reports
            Route::get('reports','ReportController@orderProfits');
            Route::post('filter','ReportController@filterProfits');

            //reservations
            Route::get('reservations','ReservationController@index');

            //orders without register
            Route::apiResource('offline-orders','OfflineOrderController');

            //contacts
            Route::apiResource('contacts','ContactController')->only('show','index','destroy');
            Route::apiResource('newsletters','NewsLetterController')->only('index','destroy');
            //settings
            Route::get('settings','SettingController@index');
            Route::post('settings/update','SettingController@update');


        });


    });//end of dashboard





});//end of lang
