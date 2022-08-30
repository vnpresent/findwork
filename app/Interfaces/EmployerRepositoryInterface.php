<?php

namespace App\Interfaces;

interface EmployerRepositoryInterface
{
    public function getAllEmployers();

    public function getEmployer($id);

    public function updateEmployer($id, $name, $password);

    public function deleteEmployer($id);
}
