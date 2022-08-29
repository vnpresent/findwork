<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // kiểm tra xem tài khoản quản lý có quyền đó không
    public function hasPermission($permission)
    {
        foreach (auth('manager')->user()->getRoles as $role)
            if ($role->getPermissions->contains('key_code', $permission))
                return true;
        return false;
    }

    // relationship lấy các role của tài khoản quản lý
    public function getRoles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getPermissions()
    {
        return $this->hasManyThrough(Permission::class,Role::class);
    }
}
