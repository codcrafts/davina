<?php

namespace App\Http\Requests\Dashboard\Notification;

use App\Http\Requests\RequestBaseAPI;
use App\Notifications\ReceivedNotify;
use Illuminate\Foundation\Http\FormRequest;

class SendSingleNotifyRequest extends RequestBaseAPI
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

             return [
                'user_id'=>'required|exists:users,id',
                 'title'=>'required|string',
                 'body'=>'required|string'
             ];

    }
    public function messages()
    {
        return [
            'title.required'=>'عنوان الاشعار مطلوب',
            'body.required'=>'محتوي الاشعار مطلوب'
        ];
    }


}
