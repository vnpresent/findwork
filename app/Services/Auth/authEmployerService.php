<?php

namespace App\Services\Auth;

use App\Models\Employer;
use App\Services\ValidateInputServices\Auth\validateInputAuthService;

class authEmployerService
{
    protected $validateInputAuthService;

    public function __construct(validateInputAuthService $validateInputAuthService)
    {
        $this->validateInputAuthService = $validateInputAuthService;
    }

    public function showLoginEmployerForm()
    {
        return view('auth.employer.login');
    }

    public function loginEmployer($email, $password)
    {
        try {
            $validate = $this->validateInputAuthService->validateInputLoginEmployer($email, $password);
            if ($validate !== true) {
                return redirect()->back()->with(['error' => $validate])->withInput();
            }
            $manager = auth('employer')->attempt(['email' => $email, 'password' => $password]);
            if ($manager) {
                return redirect()->route('employer.create-post');
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,sai email hoặc mật khẩu'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra'])->withInput();
        }
    }

    public function showRegisterEmployerForm()
    {
        return view('auth.employer.register');
    }

    public function registerEmployer($company_name, $email, $password)
    {
        try {
            $validate = $this->validateInputAuthService->validateInputRegisterEmployer($company_name, $email, $password);
            if ($validate !== true) {
                return redirect()->back()->with(['error' => $validate])->withInput();
            }
            $employer = Employer::create([
                'company_name' => $company_name,
                'email' => $email,
                'password' => bcrypt($password),
            ]);
            return redirect()->back()->with(['success' => 'Đăng ký thành công']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra'])->withInput();
        }
    }
}
