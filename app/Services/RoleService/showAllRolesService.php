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
            // gọi repo lấy tất cả role,sau đó trả về view kèm danh sách role đã lấy
            $roles = $this->roleRepository->getAllRoles();
            return view('role.show_all_roles', ['roles' => $roles]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
