<?php

namespace App\Services\Auth;

use App\Models\Manager;
use App\Services\ValidateInputServices\validateInputManagerService;

class AuthManagerService
{
    protected $validateInputManagerService;

    public function __construct(validateInputManagerService $validateInputManagerService)
    {
        $this->validateInputManagerService = $validateInputManagerService;
    }

    public function showLoginForm()
    {
        return view('manager.login');
    }

    public function login($email, $password)
    {
        $validate = $this->validateInputManagerService->validateLoginManager($email, $password);
        if ($validate !== true) {
            return redirect()->back()->with(['error' => $validate]);
        }
        $manager = auth('manager')->attempt(['email' => $email, 'password' => $password]);
        if ($manager) {
            return redirect()->route('manager.dashboard');
        } else {
            return redirect()->back()->with(['error' => 'Sai tài khoản hoặc mật khẩu']);
        }
    }
}
