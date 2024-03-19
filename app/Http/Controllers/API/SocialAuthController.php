<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\SocialSignUpRequest;
use App\Http\Resources\API\Auth\AuthUserResource;
use App\Http\Traits\ApiResponses;
use App\Models\SocialProvider;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Http\Request;
use JWTAuth;

class SocialAuthController extends Controller
{
    use ApiResponses;

    public function socialSign(SocialSignUpRequest $request){
        //check access_token existing
        $access_token=SocialProvider::where('provider_type',$request->provider_type)
                                      ->where('access_token',$request->access_token)
                                      ->first();

        if($access_token){
              $user=$access_token->user;
              $token = JWTAuth::fromUser($user);
             $oldDevice= UserDevice::where('user_id',$user->id)->first();
            if (!$oldDevice){
                $device=new UserDevice();
                $device->user_id=$user->id;
            }else{
                $device = $oldDevice;
            }

            if($request->device_type){
                $device->device_type=$request->device_type;
            }
            if($request->device_token){
                $device->device_token=$request->device_token;
            }
            $device->save();
              array_set($user, 'token', $token);
           //take the device token and device type here !!!!!!!!!
           return $this->apiResponse(new AuthUserResource($user),trans('app.messages.success_login'), 200);
        }else{
           $user=User::where('email',$request->email)->first();
           if($user){
                $provider=new SocialProvider();
                $provider->user_id=$user->id;
                $provider->provider_type=$request->provider_type;
                $provider->access_token=$request->access_token;
                $provider->save();
            $token = JWTAuth::fromUser($user);
               $oldDevice= UserDevice::where('user_id',$user->id)->first();
               if (!$oldDevice){
                   $device=new UserDevice();
                   $device->user_id=$user->id;
               }else{
                   $device = $oldDevice;
               }

               if($request->device_type){
                   $device->device_type=$request->device_type;
               }
               if($request->device_token){
                   $device->device_token=$request->device_token;
               }
               $device->save();
            array_set($user, 'token', $token);
               return $this->apiResponse(new AuthUserResource($user), trans('app.messages.success_register'), 201);
           }
           else{

               $user=User::create($request->except(['provider_type','access_token'])+['type'=>'client','is_verified'=>true]);
               $provider=new SocialProvider();
               $provider->user_id=$user->id;
               $provider->provider_type=$request->provider_type;
               $provider->access_token=$request->access_token;
               $provider->save();
              $token = JWTAuth::fromUser($user);
               $oldDevice= UserDevice::where('user_id',$user->id)->first();
               if (!$oldDevice){
                   $device=new UserDevice();
                   $device->user_id=$user->id;
               }else{
                   $device = $oldDevice;
               }

               if($request->device_type){
                   $device->device_type=$request->device_type;
               }
               if($request->device_token){
                   $device->device_token=$request->device_token;
               }
               $device->save();
             array_set($user, 'token', $token);
            return $this->apiResponse(new AuthUserResource($user), trans('app.messages.success_register'), 201);
           }

        }

        }







}
