<?php

namespace App\Services\CvService;

use App\Interfaces\CvRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Traits\CheckExistTrait;

class downloadCvService
{
    use CheckExistTrait;

    protected $cvRepository;

    public function __construct(CvRepositoryInterface $cvRepository)
    {
        $this->cvRepository = $cvRepository;
    }

    public function downloadCv($id)
    {
        try {
            $cv = $this->cvRepository->getCv($id);
            if ($this->checkExistsCv($cv) !== true) {
                return $this->checkExistsCv($cv);
            }
//            $result = $this->cvRepository->deleteCv($id);
//            if ($result) {
//                return redirect()->back()->with(['success' => 'Đã xóa CV thành công thành công']);
//            } else {
//                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
