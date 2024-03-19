<?php

namespace App\Http\Requests\Dashboard\Role;
use App\Http\Requests\RequestBaseAPI;

class StoreRoleRequest extends RequestBaseAPI
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
            'name_ar'=>'required|string',
            'name_en'=>'required|string',
            'permissions'=>'required|array',
            'permissions.*'=>'required|array',
            'permissions.*.route_name'=>'required',
            'permissions.*.is_show'=>'required|boolean',
            'permissions.*.is_create'=>'required|boolean',
            'permissions.*.is_destroy'=>'required|boolean',
            'permissions.*.is_edit'=>'required|boolean',



        ];
    }
}
