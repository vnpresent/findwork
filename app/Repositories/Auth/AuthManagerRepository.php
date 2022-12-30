<?php

namespace App\Repositories\Auth;

use App\Models\Manager;

class AuthManagerRepository implements AuthManagerRepositoryInterface
{
    public function loginManager($email, $password, $remember)
    {
        return auth('manager')->attempt(['email' => $email, 'password' => $password], $remember);
    }

    public function registerManager($name, $email, $password)
    {
        return Manager::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
    }
}
