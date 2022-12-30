<?php

namespace App\Services\RoleService;

use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Services\ValidateInputServices\validateInputRoleService;
use App\Traits\CheckExistTrait;

class createRoleService
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

    public function showCreateRoleForm()
    {
        try {
            $permissions = $this->permissionRepository->getAllPermissions();
            return view('role.create_role', ['permissions' => $permissions]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }

    public function createRole($name, $permissions)
    {
//        try {
        // kiểm tra thông tin người dùng nhập vào để tạo mới role,nếu kiểm tra có lỗi,back lại kèm lỗi
        $validate = $this->validateInputRoleService->validateInputCreateRole($name, $permissions);
        if ($validate !== true) {
            return $validate;
        }
        // kiếm tra không lỗi,gọi repo tạo role,kiểm tra kết quả trả về và back lại kèm thông báo
        $role = $this->roleRepository->createRole($name, $permissions);
        if ($this->checkExistsRole($role) === true) {
            return redirect()->back()->with(['success' => 'Đã tạo role mới thành công thành công']);
        } else {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }
}
