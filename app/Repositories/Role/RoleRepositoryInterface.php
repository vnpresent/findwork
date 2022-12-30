<?php

namespace App\Repositories\Role;

interface RoleRepositoryInterface
{
    public function getAllRoles();

    public function getRole($id);

    public function createRole($name, $permissions);

    public function updateRole($id, $name, $permissions);

    public function deleteRole($id);
}
