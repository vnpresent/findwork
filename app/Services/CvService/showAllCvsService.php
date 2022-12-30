<?php

namespace App\Services\CvService;

use App\Repositories\Cv\CvRepositoryInterface;

class showAllCvsService
{
    protected $cvRepository;

    public function __construct(CvRepositoryInterface $cvRepository)
    {
        $this->cvRepository = $cvRepository;
    }

    public function showAllCvsForm()
    {
        try {
            $cvs = $this->cvRepository->getAllCvs();
            return view('cv.show_all_cvs', ['cvs' => $cvs]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
