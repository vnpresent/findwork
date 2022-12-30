<?php

namespace App\Repositories\Applicant;

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

    public function updateApplicant($id, $name, $phone, $birthday, $address, $password)
    {
        $data = [
            'name' => $name,
            'phone' => $phone
        ];
        if ($birthday !== null) {
            $data['birthday'] = $birthday;
        }
        if ($address !== null) {
            $data['address'] = $address;
        }
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
