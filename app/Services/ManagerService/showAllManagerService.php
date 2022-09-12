<?php

namespace App\Services\ManagerService;

use App\Interfaces\ManagerRepositoryInterface;

class showAllManagerService
{
    protected $managerRepository;

    public function __construct(ManagerRepositoryInterface $managerRepository)
    {
        $this->managerRepository = $managerRepository;
    }

    public function showAllManagers()
    {
        $managers = $this->managerRepository->getAllManagers();
        return view('manager.all_manager', ['managers' => $managers]);
    }

}
