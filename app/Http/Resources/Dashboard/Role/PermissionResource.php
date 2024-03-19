<?php

namespace App\Http\Resources\Dashboard\Role;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
          'id'=>$this->id,
          'route_name'=>$this->route_name,
          'is_show'=>(bool)$this->is_show,
          'is_create'=>(bool)$this->is_create,
          'is_edit'=>(bool)$this->is_edit,
           'is_destroy' =>(bool)$this->is_destroy
        ];
    }
}
