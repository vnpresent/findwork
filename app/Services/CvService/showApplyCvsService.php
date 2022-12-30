<?php

namespace App\Services\CvService;

use App\Repositories\Cv\CvRepositoryInterface;

class showApplyCvsService
{
    protected $cvRepository;

    public function __construct(CvRepositoryInterface $cvRepository)
    {
        $this->cvRepository = $cvRepository;
    }

    public function showApplyCvsForm($post_id)
    {
//        try {
            $cvs = $this->cvRepository->getCvsOfPost($post_id);
            return view('cv.show_apply_cvs', ['cvs' => $cvs]);
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }
}
