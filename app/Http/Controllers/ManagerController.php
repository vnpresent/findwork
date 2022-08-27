<?php

namespace App\Http\Controllers;

use App\Services\managerService;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    protected $managerService;

    public function __construct(managerService $managerService)
    {
        $this->managerService = $managerService;
    }

    public function showAllManagers()
    {
        return $this->managerService->showAllManagers();
    }

    public function showCreateManageForm()
    {
        return $this->managerService->showCreateManageForm();
    }

    public function createManage(Request $request)
    {
        return $this->managerService->createManage($request->name, $request->email, $request->password);
    }

    public function showUpdateManagerForm($id)
    {
        return $this->managerService->showUpdateManagerForm($id);
    }

    public function updateManager(Request $request)
    {

    }
}
