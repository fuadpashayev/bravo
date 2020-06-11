<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public function permissionList()
    {
        return $this->hasMany('App\PermissionRole')->join('permissions','permissions.id','=','permission_role.permission_id');
    }
}
