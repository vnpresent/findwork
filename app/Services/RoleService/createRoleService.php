<?php

namespace App\Services\RoleService;

use App\Interfaces\RoleRepositoryInterface;
use App\Services\ValidateInputServices\validateInputRoleService;
use App\Traits\CheckExistTrait;

class createRoleService
{
    use CheckExistTrait;

    protected $validateInputRoleService;
    protected $roleRepository;

    public function __construct(validateInputRoleService $validateInputRoleService, RoleRepositoryInterface $roleRepository)
    {
        $this->validateInputRoleService = $validateInputRoleService;
        $this->roleRepository = $roleRepository;
    }

    public function showCreateRoleForm()
    {
        try {
            return view('role.create_role');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }

    public function createRole($name, $permissions)
    {
        try {
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
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
