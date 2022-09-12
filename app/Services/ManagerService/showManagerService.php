<?php

namespace App\Services\ManagerService;

use App\Interfaces\ManagerRepositoryInterface;
use App\Traits\CheckExistTrait;

class showManagerService
{
    use CheckExistTrait;

    protected $managerRepository;

    public function __construct(ManagerRepositoryInterface $managerRepository)
    {
        $this->managerRepository = $managerRepository;
    }

    public function showManager($id)
    {
        try {
            $manager = $this->managerRepository->getManager($id);
            if ($this->checkExistsManager($manager) !== true) {
                return $this->checkExistsManager($manager);
            }
            return view('manager.show_manager', ['manager' => $manager]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
