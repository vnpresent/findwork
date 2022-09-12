<?php

namespace App\Services\CvService;

use App\Interfaces\CvRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Traits\CheckExistTrait;

class showCvService
{
    use CheckExistTrait;

    protected $cvRepository;

    public function __construct(CvRepositoryInterface $cvRepository)
    {
        $this->cvRepository = $cvRepository;
    }

    public function showCvForm($id)
    {
        try {
            $cv = $this->cvRepository->getCv($id);
            if ($this->checkExistsCv($cv) !== true) {
                return $this->checkExistsCv($cv);
            }
            return view('cv.show_cv', ['cv' => $cv]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
