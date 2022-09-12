<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAllRoles()
    {
        return Role::all()->toArray();
    }

    public function getRole($id)
    {
        return Role::find($id)->toArray();
    }

    public function createRole($name, $permissions)
    {

    }

    public function updateRole($id, $name, $permissions)
    {
        $data = [
            'name' => $name,
        ];
        $role = Role::find($id);
        $role->getPermissions()->sync($permissions);
        return $role->update($data);
    }

    public function deleteRole($id)
    {
        return Role::find($id)->delete();
    }
}
