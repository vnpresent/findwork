<?php

namespace App\Repositories\Employer;

interface EmployerRepositoryInterface
{
    public function getAllEmployers();

    public function getEmployer($id);

    public function updateEmployer($id, $name, $password);

    public function deleteEmployer($id);

    public function addBalance($employer_id, $amount);

    public function subBalance($employer_id, $amount);

    public function updateAvatar($employer_id, $avatar);

    public function updateProfile($employer_id, $name, $description, $address);

    public function changePassword($employer_id,$new_password);

    public function buyCv($employer_id, $id);

}
