<?php

namespace App\Repositories;

use App\Interfaces\ApplicantRepositoryInterface;
use App\Models\Applicant;

class ApplicantRepository implements ApplicantRepositoryInterface
{
    public function getAllApplicants()
    {
        return Applicant::all()->toArray();
    }

    public function getApplicant($id)
    {
        return Applicant::find($id)->toArray();
    }

    public function updateApplicant($id, $name, $password)
    {
        $data = [
            'name' => $name
        ];
        if ($password !== null) {
            $data['password'] = bcrypt($password);
        }
        return Applicant::find($id)->update($data);
    }

    public function deleteApplicant($id)
    {
        return Applicant::find($id)->delete;
    }
}
