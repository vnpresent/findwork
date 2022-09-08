<?php

namespace App\Services\RoleService;

use App\Interfaces\RoleRepositoryInterface;

class showRoleService
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function showRoleForm($id)
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
