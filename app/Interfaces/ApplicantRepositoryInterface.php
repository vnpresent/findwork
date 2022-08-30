<?php

namespace App\Interfaces;

interface ApplicantRepositoryInterface
{
    public function getAllApplicants();

    public function getApplicant($id);

    public function updateApplicant($id, $name, $password);

    public function deleteApplicant($id);
}
