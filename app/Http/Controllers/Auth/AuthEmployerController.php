<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\authEmployerService;
use Illuminate\Http\Request;

class AuthEmployerController extends Controller
{
    protected $authEmployerService;

    public function __construct(authEmployerService $authEmployerService)
    {
        $this->authEmployerService = $authEmployerService;
    }

    public function showLoginEmployerForm()
    {
        return $this->authEmployerService->showLoginEmployerForm();
    }

    public function loginEmployer(Request $request)
    {
        return $this->authEmployerService->loginEmployer($request->email, $request->password);
    }

    public function showRegisterEmployerForm()
    {
        return $this->authEmployerService->showRegisterEmployerForm();
    }

    public function registerEmployer(Request $request)
    {
        return $this->authEmployerService->registerEmployer($request->company_name, $request->email, $request->password);
    }
}
