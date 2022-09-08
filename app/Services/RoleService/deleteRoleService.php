<?php

namespace App\Services\RoleService;

use App\Interfaces\RoleRepositoryInterface;
use App\Traits\CheckExistTrait;

class deleteRoleService
{
    use CheckExistTrait;

    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function deleteRole($id)
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
