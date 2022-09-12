<?php

namespace App\Services\ManagerService;

use App\Interfaces\ManagerRepositoryInterface;
use App\Services\ValidateInputServices\ValidateInputAuthService\validateInputAuthManagerService;
use App\Services\ValidateInputServices\validateInputManagerService;

class createManagerService
{
    protected $validateInputManagerService;
    protected $managerRepository;

    public function __construct(validateInputManagerService $validateInputManagerService, ManagerRepositoryInterface $managerRepository)
    {
        $this->validateInputManagerService = $validateInputManagerService;
        $this->managerRepository = $managerRepository;
    }

    public function showCreateManageForm()
    {
        return view('manager.create_manager');
    }

    public function createManage($name, $email, $password, $roles)
    {
        try {
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
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
