<?php

namespace App\Services\AuthService;

use App\Interfaces\Auth\AuthApplicantRepositoryInterface;
use App\Services\ValidateInputServices\ValidateInputAuthService\validateInputAuthApplicantService;
use App\Services\ValidateInputServices\ValidateInputAuthService\validateInputAuthEmployerService;

class authApplicantService
{
    protected $validateInputAuthApplicantService;
    protected $authApplicantRepository;

    // khai báo các service,repository được dùng
    public function __construct(validateInputAuthApplicantService $validateInputAuthApplicantService, AuthApplicantRepositoryInterface $authApplicantRepository)
    {
        $this->validateInputAuthApplicantService = $validateInputAuthApplicantService;
        $this->authApplicantRepository = $authApplicantRepository;
    }

    public function showLoginApplicantForm()
    {
        // trả về form đăng nhập cho người tìm việc
        return view('auth.applicant.login');
    }

    public function loginApplicant($email, $password, $remember)
    {
        try {
            // validate email,password người dùng gửi lên,nếu không thành công back lại kèm lỗi
            $validate = $this->validateInputAuthApplicantService->validateInputLoginApplicant($email, $password, $remember);
            if ($validate !== true) {
                return redirect()->back()->with(['error' => $validate]);
            }
            // nếu validate thành công,xác thực đăng nhập,nếu thành công back về trang chủ,nếu thất lại back lại kèm lỗi sai tài khoản mật khẩu
            $manager = $this->authApplicantRepository->loginApplicant($email, $password, $remember);
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
            $validate = $this->validateInputAuthApplicantService->validateInputRegisterApplicant($name, $email, $password);
            // kiểm tra xem có validate thành công không,nếu không thành công back lại kèm lỗi và input cũ
            if ($validate !== true) {
                return redirect()->back()->with(['error' => $validate])->withInput();
            }
            // thành công tạo mới applicant và back lại kèm thông báo đăng ký thành công
            $applicant = $this->authApplicantRepository->registerApplicant($name, $email, $password);
            if ($applicant) {
                return redirect()->back()->with(['success' => 'Đăng ký thành công']);
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra'])->withInput();
        }
    }
}
