<?php

namespace App\Services\ManagerService;

use App\Repositories\Manager\ManagerRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Services\ValidateInputServices\validateInputManagerService;
use App\Traits\CheckExistTrait;

class updateManagerService
{
    use CheckExistTrait;

    protected $validateInputManagerService;
    protected $managerRepository;
    protected $roleRepository;

    public function __construct(validateInputManagerService $validateInputManagerService, ManagerRepositoryInterface $managerRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->validateInputManagerService = $validateInputManagerService;
        $this->managerRepository = $managerRepository;
        $this->roleRepository = $roleRepository;
    }


    public function showUpdateManagerForm($id)
    {
        try {
            $manager = $this->managerRepository->getManager($id);
            $roles = $this->roleRepository->getAllRoles();
            if ($this->checkExistsManager($manager) !== true) {
                return $this->checkExistsManager($manager);
            }
            return view('manager.update_manager', ['manager' => $manager, 'roles' => $roles]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }

    }

    public function updateManager($id, $name, $roles)
    {
        try {
//            $validate = $this->validateInputManagerService->validateInputUpdateManager($id, $name, $roles);
//            if ($validate !== true) {
//                return $validate;
//            }
            $manager = $this->managerRepository->getManager($id);
            if ($this->checkExistsManager($manager) !== true) {
                return $this->checkExistsManager($manager);
            }
            $result = $this->managerRepository->updateManager($id, $name, $roles);
            if ($result) {
                return redirect()->back()->with(['success' => 'Đã cập nhật tài khoản quản lý thành công']);
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
