<?php

namespace App\Repositories\Role;

use App\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAllRoles()
    {
        return Role::all()->toArray();
    }

    public function getRole($id)
    {
        $data = [];
        $role = (array)optional(Role::with('getPermissions')->find($id))->toArray();
        $data['id'] = $role['id'];
        $data['name'] = $role['name'];
        $data['permissions'] = array_column($role['get_permissions'], 'id');
        return $data;
    }

    public function createRole($name, $permissions)
    {
        $data = [
            'name' => $name,
        ];
        $role = Role::create($data);
        $role->getPermissions()->attach($permissions);
        return $role->toArray();
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
