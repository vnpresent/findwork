<?php

namespace App\Repositories\Applicant;

interface ApplicantRepositoryInterface
{
    public function getAllApplicants();

    public function getApplicant($id);

    public function updateApplicant($id, $name, $phone, $birthday, $address, $password);

    public function deleteApplicant($id);
}
