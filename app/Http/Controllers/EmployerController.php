<?php

namespace App\Http\Controllers;

use App\Services\EmployerService\deleteEmployerService;
use App\Services\EmployerService\showAllEmployersService;
use App\Services\EmployerService\showEmployerService;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    protected $showAllEmployersService;
    protected $showEmployerService;
    protected $deleteEmployerService;

    public function __construct(showAllEmployersService $showAllEmployersService, deleteEmployerService $deleteEmployerService, showEmployerService $showEmployerService)
    {
        $this->showAllEmployersService = $showAllEmployersService;
        $this->showEmployerService = $showEmployerService;
        $this->deleteEmployerService = $deleteEmployerService;
    }

    public function showAllEmployersForm()
    {
        return $this->showAllEmployersService->showAllEmployersForm();
    }

    public function showEmployerForm($id)
    {
        return $this->showEmployerService->showEmployerForm($id);
    }

    public function deleteEmployer(Request $request)
    {
        return $this->deleteEmployerService->deleteEmployer($request->id);
    }
}
