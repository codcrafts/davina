<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Profile\ResetPasswordRequest;
use App\Http\Requests\API\Profile\UpdateProfileRequest;
use App\Http\Resources\API\Profile\ClientProfileResource;
use App\Http\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    use ApiResponses;

    public function editProfile(UpdateProfileRequest $request){
        $client=auth('api')->user();
        $profile=$request->validated();
        $client->update($profile);
        return $this->apiResponse(new ClientProfileResource($client),trans('app.messages.updated_successfully'),200);
    }

    public function getProfile(){
        $client=auth('api')->user();
        return $this->apiResponse(new ClientProfileResource($client),'',200);
    }

    public function changePassword(ResetPasswordRequest $request){
        $user = auth('api')->user();
        if(!Hash::check($request->current_password,$user->password)){
            return $this->apiResponse(null,trans('app.messages.password_wrong'),422);
        }
        $user->update(['password'=>$request->new_password]);
        return $this->apiResponse(null,trans('app.messages.password_changed'),200);
    }



}
