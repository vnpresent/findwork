<?php

namespace App\Services\Auth;

use App\Models\Manager;
use App\Services\ValidateInputServices\validateInputManagerService;

class AuthUserService
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
//        $manager = new  Manager();
//        $manager->name = 'phuong2k';
//        $manager->email = 'phuong2k@gmail.com';
//        $manager->password = bcrypt('phuong2k');
//        $manager->save();
        $validate = $this->validateInputManagerService->validateLoginManage($email, $password);
        if ($validate !== true) {
            return redirect()->back()->with(['error' => $validate]);
        }
        $manager = auth('web')->attempt(['email' => $email, 'password' => $password]);
        dd($manager);
    }
}
