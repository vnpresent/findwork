<?php

namespace App\Services\ApplicantService;


use App\Repositories\Applicant\ApplicantRepositoryInterface;
use App\Traits\CheckExistTrait;

class deleteApplicantService
{
    use CheckExistTrait;

    protected $applicantRepository;

    public function __construct(ApplicantRepositoryInterface $applicantRepository)
    {
        $this->applicantRepository = $applicantRepository;
    }

    public function deleteApplicant($id)
    {
        try {
            $applicant = $this->applicantRepository->getApplicant($id);
            if ($this->checkExistsApplicant($applicant) !== true) {
                return $this->checkExistsApplicant($applicant);
            }
            $result = $this->applicantRepository->deleteApplicant($id);
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
