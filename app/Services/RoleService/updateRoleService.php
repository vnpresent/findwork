<?php

namespace App\Services\RoleService;

use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Services\ValidateInputServices\validateInputRoleService;
use App\Traits\CheckExistTrait;

class updateRoleService
{
    use CheckExistTrait;

    protected $validateInputRoleService;
    protected $roleRepository;
    protected $permissionRepository;

    public function __construct(validateInputRoleService $validateInputRoleService, RoleRepositoryInterface $roleRepository, PermissionRepositoryInterface $permissionRepository)
    {
        $this->validateInputRoleService = $validateInputRoleService;
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function showUpdateRoleForm($id)
    {
        try {
            // gọi repo lấy role và kiểm tra role có tồn tại không,nếu không back lại kèm thông báo không tồn tại role
            $role = $this->roleRepository->getRole($id);
            $permissions = $this->permissionRepository->getAllPermissions();
            if ($this->checkExistsRole($role) !== true) {
                return $this->checkExistsRole($role);
            }
            // nếu tồn tại role,trả về view lèm bản ghi role vừa lấy được
            return view('role.update_role', ['role' => $role, 'permissions' => $permissions]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau']);
        }
    }

    public function updateRole($id, $name, $permissions)
    {
        try {
            // validate giá trị người dùng nhập vào,nếu validate lỗi,back lại kèm thông báo lỗi
            $validate = $this->validateInputRoleService->validateInputUpdateRole($name, $permissions);
            if ($validate !== true) {
                return $validate;
            }
            // kiểm tra xem có tồn tại role cần update không,nếu không tồn tại back lại kèm báo lỗi không tồn tại role
            $role = $this->roleRepository->getRole($id);
            if ($this->checkExistsRole($role) !== true) {
                return $this->checkExistsRole($role);
            }
            // gọi repo update role,kiểm tra kết quả trả về và thông báo kết quả
            $result = $this->roleRepository->updateRole($id, $name, $permissions);
            if ($result) {
                return redirect()->back()->with(['success' => 'Đã cập nhật Role thành công']);
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
