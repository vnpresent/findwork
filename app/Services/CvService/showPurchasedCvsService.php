<?php

namespace App\Services\CvService;

use App\Repositories\Cv\CvRepositoryInterface;

class showPurchasedCvsService
{
    protected $cvRepository;

    public function __construct(CvRepositoryInterface $cvRepository)
    {
        $this->cvRepository = $cvRepository;
    }

    public function showPurchasedCvsForm()
    {
//        try {
            $employer_id = auth('employer')->user()->id;
            $cvs = $this->cvRepository->getPurchasedCvs($employer_id);
            return view('cv.show_purchased_cvs', ['cvs' => $cvs]);
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }
}
