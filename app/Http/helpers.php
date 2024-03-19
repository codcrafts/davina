<?php


use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;


function saveImage($file){

    Image::make($file)
//        ->resize(600, null, function ($constraint) {
//            $constraint->aspectRatio();
//        })
        ->save(storage_path('app/public/uploads/' . $file->hashName()));
    return $file->hashName();


}


//function resize_image($image_path, $width = null , $height = null ,$format = 'jpeg', $quality = 100) {
//    if (isset($image_path) && file_exists($image_path)) {
//        $dim = getimagesize($image_path);
//        $width = $width ?? $dim[0];
//        $height = $height ?? $dim[1];
//        // \Log::info([$width,$height]);
//        $image = Image::make($image_path)->resize($width,$height)->encode($format, $quality);
//        $base64 = 'data:image/'.$format.';base64,' . base64_encode($image);
//        return $base64;
//    }
//}
function random_colors()
{
    $color_array = [
        'slate-300', 'grey-300', 'brown-300', 'green-600', 'brown-600',
        'orange-300', 'orange-700', 'slate-700', 'green-300', 'teal-300',
        'blue-300', 'green-800', 'blue-600', 'blue-800', 'indigo-300', 'indigo-700',
        'purple-300', 'purple-600', 'violet-300', 'violet-600', 'pink-300', 'pink-600',
        'info-300', 'info-600', 'info-800', 'danger-300', 'danger-600'
    ];
    return $color_array[array_rand($color_array)];
}


// function settings($key = null, $value = null) {
//        if ($key === null) {
//            return app(App\Models\Setting::class);
//        }
//        return app(App\Models\Setting::class)->get($key, $value);
//
//}
function settings($key)
{

   $settings = Setting::where('key',$key)->first();
   return @$settings->value;
}

//function settings($key)
//{
//    static $settings;
//
//    if(is_null($settings))
//    {
//        $settings = Cache::remember('settings', 24*60, function() {
//            return array_pluck(App\Models\Setting::all()->toArray(), 'value', 'key');
//        });
//    }
//
//    return (is_array($key)) ? array_only($settings, $key) : $settings[$key];
//}
   function push_notification($token,$data){
       $optionBuilder = new OptionsBuilder();
       $optionBuilder->setTimeToLive(60*20);

       $notificationBuilder = new PayloadNotificationBuilder($data['title']);
       $notificationBuilder->setBody($data['body'])
           ->setSound('default');

       $dataBuilder = new PayloadDataBuilder();
       $dataBuilder->addData($data);

       $option = $optionBuilder->build();
       $notification = $notificationBuilder->build();
       $data = $dataBuilder->build();
       $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
       return $downstreamResponse;




  }
