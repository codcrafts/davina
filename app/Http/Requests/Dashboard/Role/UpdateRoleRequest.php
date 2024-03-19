<?php

namespace App\Http\Requests\Dashboard\Role;

use App\Http\Requests\RequestBaseAPI;


class UpdateRoleRequest extends RequestBaseAPI
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
            'name_ar'=>'nullable|string',
            'name_en'=>'nullable|string',
            'permissions'=>'nullable|array',
            'permissions.*'=>'nullable|array',
            'permissions.*.route_name'=>'nullable',
            'permissions.*.is_show'=>'nullable|in:1,0',
            'permissions.*.is_create'=>'nullable|in:1,0',
            'permissions.*.is_destroy'=>'nullable|in:1,0',
            'permissions.*.is_edit'=>'nullable|in:1,0',
        ];
    }
}
