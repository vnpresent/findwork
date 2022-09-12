<?php

namespace App\Services\ManagerService;

use App\Interfaces\ManagerRepositoryInterface;
use App\Models\Manager;
use App\Services\ValidateInputServices\ValidateInputAuthService\validateInputAuthManagerService;
use App\Services\ValidateInputServices\validateInputManagerService;
use App\Traits\CheckExistTrait;

class deleteManagerService
{
    use CheckExistTrait;

    protected $managerRepository;

    public function __construct(ManagerRepositoryInterface $managerRepository)
    {
        $this->managerRepository = $managerRepository;
    }

    public function deleteManager($id)
    {
        try {
            $manager = $this->managerRepository->getManager($id);
            if ($this->checkExistsManager($manager) !== true) {
                return $this->checkExistsManager($manager);
            }
            $result = $this->managerRepository->deleteManager($id);
            if ($result) {
                return redirect()->back()->with(['success' => 'Đã xóa tài khoản quản lý thành công thành công']);
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
            }
        } catch (\Exception $e) {

        }
    }
}
