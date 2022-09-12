<?php

namespace App\Services\ManagerService;

use App\Interfaces\ManagerRepositoryInterface;
use App\Services\ValidateInputServices\validateInputManagerService;
use App\Traits\CheckExistTrait;

class updateManagerService
{
    use CheckExistTrait;

    protected $validateInputManagerService;
    protected $managerRepository;

    public function __construct(validateInputManagerService $validateInputManagerService, ManagerRepositoryInterface $managerRepository)
    {
        $this->validateInputManagerService = $validateInputManagerService;
        $this->managerRepository = $managerRepository;
    }


    public function showUpdateManagerForm($id)
    {
        try {
            $manager = $this->managerRepository->getManager($id);
            if ($this->checkExistsManager($manager) !== true) {
                return $this->checkExistsManager($manager);
            }
            return view('manager.update_manager', ['manager' => $manager]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }

    }

    public function updateManager($id, $name, $password, $roles)
    {
        try {
            $validate = $this->validateInputManagerService->validateInputUpdateManager($id, $name, $password, $roles);
            if ($validate !== true) {
                return $validate;
            }
            $manager = $this->managerRepository->getManager($id);
            if ($this->checkExistsManager($manager) !== true) {
                return $this->checkExistsManager($manager);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
