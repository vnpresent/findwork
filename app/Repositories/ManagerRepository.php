<?php

namespace App\Repositories;

use App\Interfaces\ManagerRepositoryInterface;
use App\Models\Manager;
use Illuminate\Support\Facades\DB;

class ManagerRepository implements ManagerRepositoryInterface
{
    public function getAllManagers()
    {
        return Manager::with('getRoles')->get()->toArray();
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
        return Manager::find($id)->toArray();
    }

    public function getRolesOfManager($id)
    {
        return Manager::find($id)->getRoles;
    }

    public function updateManager($id, $name, $password, $roles)
    {
        $data = [
            'name' => $name
        ];
        if ($password !== null) {
            $data['password'] = $password;
        }
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
