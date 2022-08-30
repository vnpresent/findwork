<?php

namespace App\Repositories;

use App\Interfaces\ManagerRepositoryInterface;
use App\Models\Manager;

class ManagerRepository implements ManagerRepositoryInterface
{
    public function getAllManagers()
    {
        return Manager::with('getRoles')->get();
    }

    public function createManager($name, $email, $password, $roles)
    {
        $manager = Manager::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
        $manager->getRoles()->attach($roles);
        return $manager;
    }

    public function getManager($id)
    {
        return Manager::find($id);
    }

    public function getRolesOfManager($id)
    {
        return Manager::find($id)->getRoles;
    }

    public function updateManager($id, $name, $password, $roles)
    {
        $data = [];
        if ($name !== null) {
            $data['name'] = $name;
        }
        if ($password !== null) {
            $data['password'] = $password;
        }
        $manager = Manager::find($id);
        $manager->getRoles()->sync($roles);
        return $manager->update($data);
    }

    public function deleteManager($id)
    {
        return Manager::find($id)->delete();
    }
}
