<?php

namespace App\Repositories\Permission;

use App\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function getAllPermissions()
    {
        $data = [];
        $permissions = Permission::where('parent_id', '0')->get()->toArray();
        foreach ($permissions as $permission) {
            $data[] = [
                'id' => $permission['id'],
                'name' => $permission['name'],
                'childs' => $this->getChildOfPermissionById($permission['id'])
            ];
        }
        return $data;
    }

    public function getChildOfPermissionById($id)
    {
        $data = [];
        $permissions = Permission::where('parent_id', $id)->get()->toArray();
        foreach ($permissions as $permission) {
            $data[] = [
                'id' => $permission['id'],
                'name' => $permission['name'],
            ];
        }
        return $data;
    }
}
