<?php

namespace App\Services\AuthService;

use App\Interfaces\Auth\AuthEmployerRepositoryInterface;
use App\Models\Employer;
use App\Services\ValidateInputServices\ValidateInputAuthService\validateInputAuthEmployerService;

class authEmployerService
{
    protected $validateInputAuthService;
    protected $authEmployerRepository;

    public function __construct(validateInputAuthEmployerService $validateInputAuthService, AuthEmployerRepositoryInterface $authEmployerRepository)
    {
        $this->validateInputAuthService = $validateInputAuthService;
        $this->authEmployerRepository = $authEmployerRepository;
    }

    public function showLoginEmployerForm()
    {
        return view('auth.employer.login');
    }

    public function loginEmployer($email, $password, $remember)
    {
        try {
            $validate = $this->validateInputAuthService->validateInputLoginEmployer($email, $password, $remember);
            if ($validate !== true) {
                return redirect()->back()->with(['error' => $validate])->withInput();
            }
            $employer = $this->authEmployerRepository->loginEmployer($email, $password, $remember);
            if ($employer) {
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

    public function registerEmployer($name, $email, $password)
    {
        try {
            $validate = $this->validateInputAuthService->validateInputRegisterEmployer($name, $email, $password);
            if ($validate !== true) {
                return redirect()->back()->with(['error' => $validate])->withInput();
            }
            $employer = Employer::create([
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
