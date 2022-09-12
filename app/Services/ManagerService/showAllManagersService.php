<?php

namespace App\Services\ManagerService;

use App\Interfaces\ManagerRepositoryInterface;

class showAllManagersService
{
    protected $managerRepository;

    public function __construct(ManagerRepositoryInterface $managerRepository)
    {
        $this->managerRepository = $managerRepository;
    }

    public function showAllManagers()
    {
        try {
            $managers = $this->managerRepository->getAllManagers();
            return view('manager.all_manager', ['managers' => $managers]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
