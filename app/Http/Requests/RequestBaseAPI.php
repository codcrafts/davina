<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use JWTAuth;

class RequestBaseAPI extends FormRequest
{

    public function expectsJson()
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        // $data['field'] = $validator->errors()->keys()[0];
        $data['data'] = null;
        $data['status'] = false;
        $data['field'] = $validator->errors()->keys()[0];
        $data['msg'] = $validator->errors()->first();
        throw new HttpResponseException(response()->json($data, JsonResponse::HTTP_UNPROCESSABLE_ENTITY)); // 422
    }
}
