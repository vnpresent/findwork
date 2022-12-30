<?php

namespace App\Services\RoleService;

use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Traits\CheckExistTrait;

class showRoleService
{
    use CheckExistTrait;

    protected $roleRepository;
    protected $permissionRepository;

    public function __construct(RoleRepositoryInterface $roleRepository, PermissionRepositoryInterface $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function showRoleForm($id)
    {
        try {
            // lấy thông tin role cần hiển thị,kiểm tra xem bản ghi có rỗng không,nếu có thông báo không tồn tại role
            $role = $this->roleRepository->getRole($id);
            if ($this->checkExistsRole($role) !== true) {
                return $this->checkExistsRole($role);
            }
            $permissions = $this->permissionRepository->getAllPermissions();
            // nếu không,trả về view kèm bản ghi role vừa lấy đươc
            return view('role.show_role', ['role' => $role, 'permissions' => $permissions]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
