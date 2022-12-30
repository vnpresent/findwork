<?php

namespace App\Repositories\Manager;

interface ManagerRepositoryInterface
{
    public function getAllManagers();

    public function createManager($name, $email, $password, $roles);

    public function getManager($id);

    public function getRolesOfManager($id);

    public function updateManager($id, $name, $roles);

    public function deleteManager($id);
}
