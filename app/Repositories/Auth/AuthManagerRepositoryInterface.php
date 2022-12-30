<?php

namespace App\Repositories\Auth;

interface AuthManagerRepositoryInterface
{
    public function loginManager($email, $password, $remember);

    public function registerManager($name, $email, $password);
}
