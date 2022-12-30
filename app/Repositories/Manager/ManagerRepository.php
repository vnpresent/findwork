<?php

namespace App\Repositories\Manager;

use App\Models\Manager;
use Illuminate\Support\Facades\DB;

class ManagerRepository implements ManagerRepositoryInterface
{
    public function getAllManagers()
    {
        $data = [];
        $managers = Manager::with('getRoles')->get()->toArray();
        foreach ($managers as $manager) {
            $data[] = [
                'id' => $manager['id'],
                'name' => $manager['name'],
                'email' => $manager['email'],
                'roles' => array_column($manager['get_roles'], 'name')
            ];
        }
        return $data;
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
        $data = [];
        $manager = Manager::with('getRoles')->find($id)->toArray();
        $data['id'] = $manager['id'];
        $data['name'] = $manager['name'];
        $data['email'] = $manager['email'];
        $data['roles'] = array_column($manager['get_roles'], 'id');
        return $data;
    }

    public function getRolesOfManager($id)
    {
        return Manager::find($id)->getRoles;
    }

    public function updateManager($id, $name, $roles)
    {
        $data = [
            'name' => $name
        ];
//        if ($password !== null) {
//            $data['password'] = $password;
//        }
        DB::beginTransaction();
        try {
            $manager = Manager::find($id);
            $manager->getRoles()->sync($roles);
            $result = $manager->update($data);
            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function deleteManager($id)
    {
        return Manager::find($id)->delete();
    }
}
