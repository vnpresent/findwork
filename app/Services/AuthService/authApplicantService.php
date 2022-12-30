<?php

namespace App\Services\AuthService;

use App\Repositories\Applicant\ApplicantRepositoryInterface;
use App\Repositories\Auth\AuthApplicantRepositoryInterface;
use App\Services\ValidateInputServices\ValidateInputAuthService\validateInputAuthApplicantService;
use Illuminate\Support\Facades\Hash;

class authApplicantService
{
    protected $validateInputAuthApplicantService;
    protected $authApplicantRepository;
    protected $applicantRepository;

    // khai báo các service,repository được dùng
    public function __construct(validateInputAuthApplicantService $validateInputAuthApplicantService, AuthApplicantRepositoryInterface $authApplicantRepository, ApplicantRepositoryInterface $applicantRepository)
    {
        $this->validateInputAuthApplicantService = $validateInputAuthApplicantService;
        $this->authApplicantRepository = $authApplicantRepository;
        $this->applicantRepository = $applicantRepository;
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
                return $validate;
            }
            // nếu validate thành công,xác thực đăng nhập,nếu thành công back về trang chủ,nếu thất lại back lại kèm lỗi sai tài khoản mật khẩu
            $manager = $this->authApplicantRepository->loginApplicant($email, $password, $remember);
            if ($manager) {
                return redirect()->route('index');
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,sai email hoặc mật khẩu'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
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
                return $validate;
            }
            // thành công tạo mới applicant và back lại kèm thông báo đăng ký thành công
            $applicant = $this->authApplicantRepository->registerApplicant($name, $email, $password);
            if ($applicant) {
                return redirect()->back()->with(['success' => 'Đăng ký thành công']);
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }

    public function showUpdateProfileForm()
    {
        return view('auth.applicant.update_profile');
    }

    public function updateProfile($name, $phone, $birthday, $address, $password, $new_password, $new_password1)
    {
//        try {
        $data = [];
        if ($password != null) {
            if (Hash::check($password, auth('applicant')->user()->password)) {
                if ($new_password != $new_password1) {
                    $new_password = null;
                    $data['error'] = 'Mật khẩu nhập lại sai';
                }
            } else {
                $new_password = null;
                $data['error'] = 'Mật khẩu cũ sai';
            }
        }
        $id = auth('applicant')->user()->id;
        if ($this->applicantRepository->updateApplicant($id, $name, $phone, $birthday, $address, $new_password)) {
            $data['success'] = 'Cập nhật thành công';
            return redirect()->back()->with($data);
        } else {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }

    public function logout()
    {
        auth('applicant')->logout();
        return redirect()->route('index');
    }
}
