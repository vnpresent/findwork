<?php

namespace App\Services\CvService;

use App\Interfaces\CvRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Traits\CheckExistTrait;

class createCvService
{
    use CheckExistTrait;

    protected $cvRepository;

    public function __construct(CvRepositoryInterface $cvRepository)
    {
        $this->cvRepository = $cvRepository;
    }

    public function showCreateCvForm()
    {
        try {
            return view('cv.create_cv',);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }

    public function createCv()
    {
        try {

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
