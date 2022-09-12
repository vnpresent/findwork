<?php

namespace App\Services\ApplicantService;


use App\Interfaces\ApplicantRepositoryInterface;
use App\Traits\CheckExistTrait;

class updateApplicantService
{
    use CheckExistTrait;

    protected $applicantRepository;

    public function __construct(ApplicantRepositoryInterface $applicantRepository)
    {
        $this->applicantRepository = $applicantRepository;
    }

    public function showUpdateApplicantForm($id)
    {
        try {
            $applicant = $this->applicantRepository->getApplicant($id);
            if ($this->checkExistsApplicant($applicant) !== true) {
                return $this->checkExistsApplicant($applicant);
            }
            return view('applicant.show_applicant', ['applicant' => $applicant]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }

    public function updateApplicant($id, $name, $password)
    {
        try {
            $applicant = $this->applicantRepository->getApplicant($id);
            if ($this->checkExistsApplicant($applicant) !== true) {
                return $this->checkExistsApplicant($applicant);
            }
            $result = $this->applicantRepository->updateApplicant($id, $name, $password);
            if ($result) {
                return redirect()->back()->with(['success' => 'Đã cập nhật tài khoản người dùng thành công']);
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
