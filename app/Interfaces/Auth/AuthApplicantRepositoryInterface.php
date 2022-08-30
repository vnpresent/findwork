<?php

namespace App\Interfaces\Auth;

interface AuthApplicantRepositoryInterface
{
    public function loginApplicant($email, $password, $remember);

    public function registerApplicant($name, $email, $password);
}
