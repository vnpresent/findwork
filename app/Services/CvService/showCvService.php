<?php

namespace App\Services\CvService;

use App\Repositories\Cv\CvRepositoryInterface;
use App\Traits\CheckExistTrait;

class showCvService
{
    use CheckExistTrait;

    protected $cvRepository;
    protected $checkCvService;

    public function __construct(CvRepositoryInterface $cvRepository, checkCvService $checkCvService)
    {
        $this->cvRepository = $cvRepository;
        $this->checkCvService = $checkCvService;
    }

    public function showCvForm($id)
    {
//        try {
        $cv = $this->cvRepository->getCv($id);
        if ($this->checkExistsCv($cv) !== true) {
            return $this->checkExistsCv($cv);
        }
        if (!$this->checkCvService->checkCv($id)) {
            $cv['profile']['phone'] = '************';
            $cv['profile']['email'] = '************';
        }
        return view('cv.show_cv', ['cv' => $cv]);
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }
}
