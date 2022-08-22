<?php

namespace App\Services;

use App\Models\Manager;
use App\Services\ValidateInputServices\validateInputManagerService;

class managerService
{
    protected $validateInputManagerService;

    public function __construct(validateInputManagerService $validateInputManagerService)
    {
        $this->validateInputManagerService = $validateInputManagerService;
    }

    public function dashboard()
    {
        return view('manager.dashboard');
    }

    public function showCreateManageForm()
    {
        return view('manager.create_manager');
    }

    public function createManage($name, $email, $password)
    {
        try {
            $validate = $this->validateInputManagerService->validateCreateManager($name, $email, $password);
            if ($validate !== true) {
                return redirect()->back()->with(['error' => $validate])->withInput();
            }
            Manager::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
            ]);
            return redirect()->back()->with(['success' => 'Đã tạo tài khoản quản lý thành công']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra'])->withInput();
        }
    }
}
