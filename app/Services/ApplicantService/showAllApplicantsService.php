<?php

namespace App\Services\ApplicantService;


use App\Interfaces\ApplicantRepositoryInterface;

class showAllApplicantsService
{
    protected $applicantRepository;

    public function __construct(ApplicantRepositoryInterface $applicantRepository)
    {
        $this->applicantRepository = $applicantRepository;
    }

    public function showAllApplicantsForm()
    {
        try {
            $applicants = $this->applicantRepository->getAllApplicants();
            return view('applicant.show_all_applicants', ['applicants' => $applicants]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
