<?php

namespace App\Services\EmployerService;

use App\Repositories\Employer\EmployerRepositoryInterface;
use App\Traits\CheckExistTrait;

class deleteEmployerService
{
    use CheckExistTrait;

    protected $employerRepository;

    public function __construct(EmployerRepositoryInterface $employerRepository)
    {
        $this->employerRepository = $employerRepository;
    }

    public function deleteEmployer($id)
    {
        try {
            $employer = $this->employerRepository->getEmployer($id);
            if ($this->checkExistsEmployer($employer) !== true) {
                return $this->checkExistsEmployer($employer);
            }
            if ($this->employerRepository->deleteEmployer($id)) {
                return redirect()->back()->with(['success' => 'Đã xóa tài khoản Nhà Tuyển Dụng thành công thành công']);
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
