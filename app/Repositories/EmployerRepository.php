<?php

namespace App\Repositories;

use App\Interfaces\EmployerRepositoryInterface;
use App\Models\Employer;

class EmployerRepository implements EmployerRepositoryInterface
{
    public function getAllEmployers()
    {
        return Employer::all();
    }

    public function getEmployer($id)
    {
        return Employer::find($id);
    }

    public function getPostsOfEmployer($id)
    {
        return Employer::find($id)->getPosts;
    }

    public function updateEmployer($id, $name, $password)
    {
        $data = [];
        if ($name !== null) {
            $data['name'] = $name;
        }
        if ($name !== null) {
            $data['password'] = bcrypt($password);
        }
        $employer = Employer::find($id);
        return $employer->update($data);
    }

    public function deleteEmployer($id)
    {
        return Employer::find($id)->delete();
    }
}
