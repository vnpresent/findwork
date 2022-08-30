<?php

namespace App\Interfaces;

interface ManagerRepositoryInterface
{
    public function getAllManagers();

    public function createManager($name, $email, $password, $roles);

    public function getManager($id);

    public function getRolesOfManager($id);

    public function updateManager($id, $name, $password, $roles);

    public function deleteManager($id);
}
