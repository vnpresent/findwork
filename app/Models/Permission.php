<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id', 'name', 'key_code',
    ];

    public function getRoles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function getPermissions()
    {
        return $this->belongsToMany(Permission::class, 'permissions', 'parent_id', 'id')->withTimestamps();
    }
}
