<?php

namespace App\Services\RoleService;

use App\Interfaces\RoleRepositoryInterface;

class showAllRolesService
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function showAllRolesForm()
    {
        try {

        } catch (\Exception $e) {

        }
    }
}
