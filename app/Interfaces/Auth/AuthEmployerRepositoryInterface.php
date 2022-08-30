<?php

namespace App\Interfaces\Auth;

interface AuthEmployerRepositoryInterface
{
    public function loginEmployer($email, $password, $remember);

    public function registerEmployer($name, $email, $password);
}
