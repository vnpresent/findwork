<?php

namespace App\Services\RoleService;

use App\Interfaces\RoleRepositoryInterface;
use App\Traits\CheckExistTrait;

class showRoleService
{
    use CheckExistTrait;

    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function showRoleForm($id)
    {
        try {
            $role = $this->roleRepository->getRole($id);
            if ($this->checkExistsRole($role) !== true) {
                return $this->checkExistsRole($role);
            }
        } catch (\Exception $e) {

        }
    }
}
