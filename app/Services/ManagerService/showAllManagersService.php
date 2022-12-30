<?php

namespace App\Services\ManagerService;

use App\Repositories\Manager\ManagerRepositoryInterface;

class showAllManagersService
{
    protected $managerRepository;

    public function __construct(ManagerRepositoryInterface $managerRepository)
    {
        $this->managerRepository = $managerRepository;
    }

    public function showAllManagersForm()
    {
        try {
            $managers = $this->managerRepository->getAllManagers();
            return view('manager.show_all_managers', ['managers' => $managers]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
