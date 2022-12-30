<?php

namespace App\Repositories\Auth;

interface AuthEmployerRepositoryInterface
{
    public function loginEmployer($email, $password, $remember);

    public function registerEmployer($name, $email, $password);
}
