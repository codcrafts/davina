<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable=['route_name','is_show','is_create','is_edit','is_destroy','role_id'];

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }
}
