<?php

namespace App\Services\Auth;

use App\Models\Manager;
use App\Services\ValidateInputServices\validateInputManagerService;

class authEmployerService
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
        $validate = $this->validateInputManagerService->validateLoginManage($email, $password);
        if ($validate !== true) {
            return redirect()->back()->with(['error' => $validate]);
        }
        $manager = auth('employer')->attempt(['email' => $email, 'password' => $password]);
        dd($manager);
    }
}
