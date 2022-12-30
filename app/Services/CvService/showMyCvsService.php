<?php

namespace App\Services\CvService;

use App\Repositories\Cv\CvRepositoryInterface;

class showMyCvsService
{
    protected $cvRepository;

    public function __construct(CvRepositoryInterface $cvRepository)
    {
        $this->cvRepository = $cvRepository;
    }

    public function showMyCvsForm()
    {
        try {
            $applicant_id = auth('applicant')->user()->id;
            $cvs = $this->cvRepository->getApplicantCvs($applicant_id);
            return view('cv.show_my_cvs', ['cvs' => $cvs]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
