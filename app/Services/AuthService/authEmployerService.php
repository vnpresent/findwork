<?php

namespace App\Services\AuthService;

use App\Models\Employer;
use App\Repositories\Auth\AuthEmployerRepositoryInterface;
use App\Repositories\Employer\EmployerRepositoryInterface;
use App\Services\SaveImageService\saveImageService;
use App\Services\ValidateInputServices\ValidateInputAuthService\validateInputAuthEmployerService;
use Illuminate\Support\Facades\Hash;

class authEmployerService
{
    protected $validateInputAuthService;
    protected $authEmployerRepository;
    protected $saveImageService;
    protected $employerRepository;

    public function __construct(validateInputAuthEmployerService $validateInputAuthService, AuthEmployerRepositoryInterface $authEmployerRepository, saveImageService $saveImageService, EmployerRepositoryInterface $employerRepository)
    {
        $this->validateInputAuthService = $validateInputAuthService;
        $this->authEmployerRepository = $authEmployerRepository;
        $this->saveImageService = $saveImageService;
        $this->employerRepository = $employerRepository;
    }

    public function showLoginEmployerForm()
    {
        return view('auth.employer.login');
    }

    public function loginEmployer($email, $password, $remember)
    {
        // try {
        $validate = $this->validateInputAuthService->validateInputLoginEmployer($email, $password, $remember);
        if ($validate !== true) {

            return redirect()->back()->with(['error' => $validate])->withInput();
        }
        $employer = $this->authEmployerRepository->loginEmployer($email, $password, $remember);
        if ($employer) {
            return redirect()->route('employer.dashboard');
        } else {
            return redirect()->back()->with(['error' => 'Thất bại,sai email hoặc mật khẩu'])->withInput();
        }
        // } catch (\Exception $e) {
        //     return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        // }
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
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }

    public function logout()
    {
        auth('employer')->logout();
        return redirect()->route('index');
    }

    public function showUpdateProfileForm()
    {
        return view('auth.employer.update_profile');
    }

    public function updateAvatar($avatar)
    {
        $employer_id = auth('employer')->user()->id;
        $avatar = $this->saveImageService->saveImage($avatar, $employer_id);
        $this->employerRepository->updateAvatar($employer_id, $avatar);
        return redirect()->route('employer.show-update-profile-form');
    }

    public function updateProfile($name, $description, $address)
    {
        $employer_id = auth('employer')->user()->id;
        $this->employerRepository->updateProfile($employer_id, $name, $description, $address);
        return redirect()->route('employer.show-update-profile-form');
    }

    public function showChangePasswordForm()
    {
        return view('auth.employer.change_password');
    }

    public function changePassword($password, $new_password, $new_password1)
    {
        if (Hash::check($password, auth('employer')->user()->password)) {
            if ($password == $new_password) {
                return redirect()->back()->with(['error' => 'Mật khẩu mới trùng với password cũ']);
            }
            if ($new_password === $new_password1) {
                if ($this->employerRepository->changePassword(auth('employer')->user()->id,$new_password)){
                    return redirect()->back()->with(['success' => 'ĐỔi mật khẩu thành công']);
                }else{
                    return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra']);
                }
            } else {
                return redirect()->back()->with(['error' => 'Mật khẩu nhập lại không đúng']);
            }
        } else {
            return redirect()->back()->with(['error' => 'Sai mật khẩu hiện tại']);
        }
    }
}
