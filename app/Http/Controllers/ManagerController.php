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

    public function dashboard()
    {
        return $this->managerService->dashboard();
    }

    public function showCreateManageForm()
    {
        return $this->managerService->showCreateManageForm();
    }

    public function createManage(Request $request)
    {
        return $this->managerService->createManage($request->name, $request->email, $request->password);
    }
}
