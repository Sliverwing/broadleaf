<?php

namespace App\Models;

use Ultraware\Roles\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    protected $fillable = [
        'slug',
        'name',
        'description',
        'model',
        'is_url_enabled',
        'url',
        'order',
    ];
}
