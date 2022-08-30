<?php

namespace App\Repositories\Auth;

use App\Interfaces\Auth\AuthApplicantRepositoryInterface;
use App\Models\Applicant;

class AuthApplicantRepository implements AuthApplicantRepositoryInterface
{
    public function loginApplicant($email, $password, $remember)
    {
        return auth('applicant')->attempt(['email' => $email, 'password' => $password], $remember);
    }

    public function registerApplicant($name, $email, $password)
    {
        return Applicant::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
    }
}
