<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\Validator;

trait ApiResponses
{

    protected function apiResponse($data = null, $msg='', $code = 200,$additional_data=[], $error = null )
    {

        if ($error != null)
        {
            $array = [
                'status' => in_array($code, $this->successCode()),
                'msg' => $error,
                'data'=>null

            ];
        }
        else
        {
            $array = [
                'status' => in_array($code, $this->successCode()),
                'data' => $data,
                'msg'=>$msg


            ];
        }
        return response($array+$additional_data, $code);
    }
    protected function successCode()
    {

        return [
            200 , 201 , 202
        ];
    }
    protected function apiValidation($request, $array){


        $validate = Validator::make($request->all() , $array);

        $errors = [];

        if ($validate->fails()) {
            return $this->apiResponse(null, $validate->getMessageBag()->first(), 422);
        }

    }
}
