<?php

namespace App\Services\Auth;

use App\Models\Applicant;
use App\Services\ValidateInputServices\Auth\validateInputAuthService;

class authApplicantService
{
    protected $validateInputAuthService;

    // khai báo các service được dùng
    public function __construct(validateInputAuthService $validateInputAuthService)
    {
        $this->validateInputAuthService = $validateInputAuthService;
    }

    public function showLoginApplicantForm()
    {
        // trả về form đăng nhập cho người tìm việc
        return view('auth.applicant.login');
    }

    public function loginApplicant($email, $password)
    {
        try {
            // validate email,password người dùng gửi lên,nếu không thành công back lại kèm lỗi
            $validate = $this->validateInputAuthService->validateInputLoginApplicant($email, $password);
            if ($validate !== true) {
                return redirect()->back()->with(['error' => $validate]);
            }
            // nếu validate thành công,xác thực đăng nhập,nếu thành công back về trang chủ,nếu thất lại back lại kèm lỗi sai tài khoản mật khẩu
            $manager = auth('applicant')->attempt(['email' => $email, 'password' => $password]);
            if ($manager) {
                return redirect()->route('index');
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,sai email hoặc mật khẩu'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra'])->withInput();
        }
    }

    public function showRegisterApplicantForm()
    {
        // trả về view đăng ký cho người tìm việc
        return view('auth.applicant.register');
    }

    public function registerApplicant($name, $email, $password)
    {
        try {
            // validate name,email,password người dùng gửi lên
            $validate = $this->validateInputAuthService->validateInputRegisterApplicant($name, $email, $password);
            // kiểm tra xem có validate thành công không,nếu không thành công back lại kèm lỗi và input cũ
            if ($validate !== true) {
                return redirect()->back()->with(['error' => $validate])->withInput();
            }
            // thành công tạo mới applicant và back lại kèm thông báo đăng ký thành công
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
