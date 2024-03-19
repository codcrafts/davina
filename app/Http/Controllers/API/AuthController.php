<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\CheckResetCodeRequest;
use App\Http\Requests\API\Auth\EmailVerifyRequest;
use App\Http\Requests\API\Auth\ForgetPasswordRequest;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Requests\API\Auth\ResendCodeRequest;
use App\Http\Requests\API\Auth\ResetPasswordRequest;
use App\Http\Resources\API\Auth\AuthUserResource;
use App\Http\Traits\ApiResponses;
use App\Mail\ForgetEmail;
use App\Mail\VerifyUser;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use JWTAuth;

class AuthController extends Controller
{
    use ApiResponses;
     //register
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated() + ['is_verified' => true,'type'=>'client']);
        //send mail with verification code to activate
        //  Mail::send(new VerifyUser($user, $user->verification_code));
        $token = JWTAuth::fromUser($user);
        $device=new UserDevice();
        $device->user_id=$user->id;

        if($request->device_type){
            $device->device_type=$request->device_type;
        }
        if($request->device_token){
            $device->device_token=$request->device_token;
        }
        $device->save();
        array_set($user, 'token', $token);
        return $this->apiResponse(new AuthUserResource($user), trans('app.messages.success_register'), 201);
    }//end of register


    //verify email
    public function verifyEmail(EmailVerifyRequest $request)
    {
        $user = User::where('email', $request->email)->where('verification_code', $request->verification_code)->first();
        if (!$user) {
            return $this->apiResponse(null, trans('app.auth.user_not_found'), 422);
        }

        if ( $user->verification_code== $request->verification_code) {

            $user->update(['is_verified' => true,'verification_code'=>null]);

            $token = JWTAuth::fromUser($user);
            $device=new UserDevice();
            $device->user_id=$user->id;

            if($request->device_type){
                $device->device_type=$request->device_type;
            }
            if($request->device_token){
                $device->device_token=$request->device_token;
            }
            $device->save();
            array_set($user, 'token', $token);
         //   return $this->apiResponse(new AuthUserResource($user), trans('app.messages.success_register'), 201);

            return $this->apiResponse(new AuthUserResource($user), trans('app.messages.activated_successfully'), 200);
        } else {
            return $this->apiResponse(null, 'something is wrong', 422);
        }
    }//end of verify email


    public function login(LoginRequest $request)
    {
        if (!$token = auth('api')->attempt($request->only(['email', 'password']))) {
            return $this->apiResponse(null, trans('app.messages.failed_login'), 422);
        }

        $user = auth('api')->user();

//        if($user->is_verified==false){
//
//            return $this->apiResponse(null, trans('app.auth.account_not_verified'), 422);
//        }
        if ($user->is_banned == true) {
            return $this->apiResponse(null, trans('app.messages.banned_message'), 422);
        }
        if($user->type=='admin')
            return $this->apiResponse(null, trans('app.messages.failed_login'), 422);

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
        return $this->apiResponse(new AuthUserResource($user), trans('app.messages.success_login'), 200);

    }//end of login

    //forget password
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $user =User::where('email', $request->email)->where('is_verified',true)->first();

        if(!$user)
        {
            return $this->apiResponse(null, trans('app.auth.user_not_found'), 422);
        }
        if ($user) {

            $reset_code = '111111';
            $user->update(['reset_code' => $reset_code]);
            /* send reset Code by sms*/
            Mail::send(new ForgetEmail($user, $user->reset_code));
            /* end sending */
            return $this->apiResponse(null, trans('app.messages.sent_code_successfully'), 200, null, ['code' => $user->reset_code]);
        }
        return $this->apiResponse(null, trans('app.auth.user_not_found'), 422);
    }//end of forget password

    //resend code
    public function ResendCode(ResendCodeRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user)
        {
            return $this->apiResponse(null, trans('app.auth.user_not_found'), 422);
        }
        if ($request->type == 'verification_code') {
            $user->update(['verification_code' => '111111']);

            /*
             * send mail
            */
        } else {
            $user->update(['reset_code' => '111111']);
            /*
             * send mail
            */
        }

        return $this->apiResponse(null, trans('app.messages.sent_code_successfully'), 200);
    }//end of resend code


    public function checkResetCode(CheckResetCodeRequest  $request){

        $user = User::where(['email'=>$request->email,'reset_code'=>$request->reset_code])->first();

        if ($user){
            //$token = JWTAuth::fromUser($user);

            return $this->apiResponse(null, trans('app.auth.reset_code_success'), 200);
        }
        return $this->apiResponse(null, trans('app.messages.wrong_code_please_try_again'), 422);
    }//end of check code

    //reset password
    public function resetPassword(ResetPasswordRequest $request)
    {
        $user = User::firstWhere('email', $request->email);
        if (!$user) {

            return $this->apiResponse(null,  trans('app.auth.user_not_found'), 422);
        }

        $user->update(['password' => $request->new_password, 'reset_code' => null]);
        return $this->apiResponse(new AuthUserResource($user), trans('app.messages.password_changed'), 200);
    }//end of reset password

    //logout method
    public function logout()
    {
        $user=auth('api')->user();
        $oldDevice= UserDevice::where('user_id',$user->id)->first();
        if ($oldDevice){
            $oldDevice->delete();
        }
        auth('api')->logout();

        return $this->apiResponse(null, trans('app.messages.success_logout'),200);
    }//end of logout













}
