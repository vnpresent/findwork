<?php

namespace App\Http\Controllers;

use App\Services\CvService\createCvService;
use App\Services\ManagerService\createManagerService;
use App\Services\ManagerService\deleteManagerService;
use App\Services\ManagerService\showAllManagersService;
use App\Services\ManagerService\updateManagerService;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    protected $createManagerService;
    protected $showAllManagersService;
    protected $deleteManagerService;
    protected $updateManagerService;

    public function __construct(createManagerService $createManagerService, showAllManagersService $showAllManagersService, deleteManagerService $deleteManagerService, updateManagerService $updateManagerService)
    {
        $this->createManagerService = $createManagerService;
        $this->showAllManagersService = $showAllManagersService;
        $this->deleteManagerService = $deleteManagerService;
        $this->updateManagerService = $updateManagerService;
    }

    public function showAllManagersForm()
    {
        return $this->showAllManagersService->showAllManagersForm();
    }

    public function showCreateManagerForm()
    {
        return $this->createManagerService->showCreateManagerForm();
    }

    public function createManager(Request $request)
    {
        return $this->createManagerService->createManager($request->name, $request->email, $request->password, $request->roles);
    }

    public function showUpdateManagerForm($id)
    {
        return $this->updateManagerService->showUpdateManagerForm($id);
    }

    public function updateManager(Request $request, $id)
    {
        return $this->updateManagerService->updateManager($id, $request->name, $request->roles);
    }

    public function deleteManager(Request $request)
    {
        return $this->deleteManagerService->deleteManager($request->id);
    }
}
