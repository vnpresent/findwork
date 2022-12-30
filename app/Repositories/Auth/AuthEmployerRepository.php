<?php

namespace App\Repositories\Auth;

use App\Models\Employer;

class AuthEmployerRepository implements AuthEmployerRepositoryInterface
{
    public function loginEmployer($email, $password, $remember)
    {
        return auth('employer')->attempt(['email' => $email, 'password' => $password], $remember);
    }

    public function registerEmployer($name, $email, $password)
    {
        return Employer::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
    }
}
