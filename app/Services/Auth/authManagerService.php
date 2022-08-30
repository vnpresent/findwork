<?php

namespace App\Services\Auth;

use App\Models\Manager;
use App\Services\ValidateInputServices\Auth\validateInputAuthManagerService;
use App\Services\ValidateInputServices\validateInputManagerService;

class authManagerService
{
    protected $validateInputAuthManagerService;

    public function __construct(validateInputAuthManagerService $validateInputAuthManagerService)
    {
        $this->validateInputAuthManagerService = $validateInputAuthManagerService;
    }

    public function showLoginManagerForm()
    {
        return view('auth.manager.login');
    }

    public function loginManager($email, $password, $remember)
    {
        $validate = $this->validateInputAuthManagerService->validateInputLoginManager($email, $password, $remember);
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
