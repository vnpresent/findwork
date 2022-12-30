<?php

namespace App\Http\Controllers;

use App\Services\RoleService\createRoleService;
use App\Services\RoleService\showAllRolesService;
use App\Services\RoleService\showRoleService;
use App\Services\RoleService\updateRoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $createRoleService;
    protected $showRoleService;
    protected $showAllRolesService;
    protected $updateRoleService;

    public function __construct(createRoleService $createRoleService,showRoleService $showRoleService, showAllRolesService $showAllRolesService, updateRoleService $updateRoleService)
    {
        $this->createRoleService = $createRoleService;
        $this->showRoleService = $showRoleService;
        $this->showAllRolesService = $showAllRolesService;
        $this->updateRoleService = $updateRoleService;
    }

    public function showAllRolesForm()
    {
        return $this->showAllRolesService->showAllRolesForm();
    }

    public function showRoleForm($id)
    {
        return $this->showRoleService->showRoleForm($id);
    }

    public function showCreateRoleForm()
    {
        return $this->createRoleService->showCreateRoleForm();
    }

    public function createRole(Request $request)
    {
        return $this->createRoleService->createRole($request->name, $request->permissions);
    }

    public function showUpdateRoleForm($id)
    {
        return $this->updateRoleService->showUpdateRoleForm($id);
    }

    public function updateRole($id, Request $request)
    {
        return $this->updateRoleService->updateRole($id, $request->name, $request->permissions);
    }

    public function deleteRole($id)
    {

    }
}
