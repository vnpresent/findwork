<?php

namespace App\Services\CvService;

use App\Repositories\Cv\CvRepositoryInterface;
use App\Traits\CheckExistTrait;
use Illuminate\Support\Facades\Gate;

class deleteCvService
{
    use CheckExistTrait;

    protected $cvRepository;

    public function __construct(CvRepositoryInterface $cvRepository)
    {
        $this->cvRepository = $cvRepository;
    }

    public function deleteCv($id)
    {
        try {
            $cv = $this->cvRepository->getCv($id);
            if ($this->checkExistsCv($cv) !== true) {
                return $this->checkExistsCv($cv);
            }
            if (Gate::allows('delete-cvs' ,$id)) {
                if ($this->cvRepository->deleteCv($id)) {
                    return redirect()->back()->with(['success' => 'Đã xóa CV thành công thành công']);
                } else {
                    return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
                }
            } else {
                return redirect()->back()->with(['error' => 'Không có quyền'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
