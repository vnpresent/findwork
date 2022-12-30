<?php

namespace App\Repositories\Permission;

interface PermissionRepositoryInterface
{
    public function getAllPermissions();

    public function getChildOfPermissionById($id);
}
