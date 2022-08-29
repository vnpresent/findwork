<?php

namespace App\Services\Auth;

use App\Models\Applicant;
use App\Services\ValidateInputServices\Auth\validateInputAuthService;

class authApplicantService
{
    protected $validateInputAuthService;

    public function __construct(validateInputAuthService $validateInputAuthService)
    {
        $this->validateInputAuthService = $validateInputAuthService;
    }

    public function showLoginApplicantForm()
    {
//        return view('manager.login');
    }

    public function loginApplicant($email, $password)
    {
//        $validate = $this->validateInputManagerService->validateLoginManage($email, $password);
//        if ($validate !== true) {
//            return redirect()->back()->with(['error' => $validate]);
//        }
//        $manager = auth('web')->attempt(['email' => $email, 'password' => $password]);
//        dd($manager);
    }

    public function showRegisterApplicantForm()
    {
        return view('auth.applicant.register');
    }

    public function registerApplicant($name, $email, $password)
    {
        try {
            $validate = $this->validateInputAuthService->validateInputRegisterApplicant($name, $email, $password);
            if ($validate !== true) {
                return redirect()->back()->with(['error' => $validate]);
            }

            $applicant = Applicant::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
            ]);

            return redirect()->back()->with(['success' => 'Đăng ký thành công']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra'])->withInput();
        }
    }
}
