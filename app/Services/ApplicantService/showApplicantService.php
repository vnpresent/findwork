<?php

namespace App\Services\ApplicantService;


use App\Repositories\Applicant\ApplicantRepositoryInterface;
use App\Traits\CheckExistTrait;

class showApplicantService
{
    use CheckExistTrait;

    protected $applicantRepository;

    public function __construct(ApplicantRepositoryInterface $applicantRepository)
    {
        $this->applicantRepository = $applicantRepository;
    }

    public function showApplicantForm($id)
    {
        try {
            $applicant = $this->applicantRepository->getApplicant($id);
            if ($this->checkExistsApplicant($id) !== true) {
                return $this->checkExistsApplicant($id);
            }
            return view('applicant.show_applicant', ['applicant' => $applicant]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
