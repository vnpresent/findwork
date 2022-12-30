<?php

namespace App\Services\ManagerService;

use App\Repositories\Manager\ManagerRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Services\ValidateInputServices\validateInputManagerService;

class createManagerService
{
    protected $validateInputManagerService;
    protected $managerRepository;
    protected $roleRepository;

    public function __construct(validateInputManagerService $validateInputManagerService, ManagerRepositoryInterface $managerRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->validateInputManagerService = $validateInputManagerService;
        $this->managerRepository = $managerRepository;
        $this->roleRepository = $roleRepository;
    }

    public function showCreateManagerForm()
    {
        $roles = $this->roleRepository->getAllRoles();
        return view('manager.create_manager', ['roles' => $roles]);
    }

    public function createManager($name, $email, $password, $roles)
    {
//        try {
            // validate name,email,password người dùng gửi lên,nếu thất bại back lại kèm lỗi
            $validate = $this->validateInputManagerService->validateInputCreateManager($name, $email, $password, $roles);
            if ($validate !== true) {
                return $validate;
            }
            if ($this->managerRepository->createManager($name, $email, $password, $roles)) {
                // nếu thành công tạo mới manager ,back lại kèm thông báo tạo tài khoản thành công
                return redirect()->back()->with(['success' => 'Đã tạo tài khoản quản lý thành công']);
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
            }
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }
}
