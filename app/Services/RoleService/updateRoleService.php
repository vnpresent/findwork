<?php

namespace App\Services\RoleService;

use App\Interfaces\RoleRepositoryInterface;

class updateRoleService
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function showUpdateRoleForm($id)
    {
        try {
            $role = $this->roleRepository->getRole($id);
            if (count($role) > 0) {

            } else {
                return redirect()->back()->with(['error' => 'Không tồn tại role'])->withInput();
            }
        } catch (\Exception $e) {

        }
    }

    public function updateRole($id)
    {
        try {
            $role = $this->roleRepository->getRole($id);
            if (count($role) > 0) {

            } else {
                return redirect()->back()->with(['error' => 'Không tồn tại role'])->withInput();
            }
        } catch (\Exception $e) {

        }
    }
}
