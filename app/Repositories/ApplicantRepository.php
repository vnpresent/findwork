<?php

namespace App\Repositories;

use App\Interfaces\ApplicantRepositoryInterface;
use App\Models\Applicant;

class ApplicantRepository implements ApplicantRepositoryInterface
{
    public function getAllApplicants()
    {
        return Applicant::all();
    }

    public function getApplicant($id)
    {
        return Applicant::find($id);
    }

    public function updateApplicant($id, $name, $password)
    {
        $data = [];
        if ($name !== null) {
            $data['name'] = $name;
        }
        if ($password !== null) {
            $data['password'] = bcrypt($password);
        }
        $applicant = Applicant::find($id);
        return $applicant->update($data);
    }

    public function deleteApplicant($id)
    {
        return Applicant::delete($id);
    }
}
