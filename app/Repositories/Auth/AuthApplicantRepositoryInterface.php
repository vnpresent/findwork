<?php

namespace App\Repositories\Auth;

interface AuthApplicantRepositoryInterface
{
    public function loginApplicant($email, $password, $remember);

    public function registerApplicant($name, $email, $password);
}
