<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\authApplicantService;
use Illuminate\Http\Request;

class AuthApplicantController extends Controller
{
    protected $authUserService;

    public function __construct(authApplicantService $authUserService)
    {
        $this->authUserService = $authUserService;
    }

    public function showLoginApplicantForm()
    {
        return $this->authUserService->showLoginApplicantForm();
    }

    public function loginApplicant(Request $request)
    {
        return $this->authUserService->loginApplicant($request->email, $request->password);
    }

    public function showRegisterApplicantForm()
    {
        return $this->authUserService->showRegisterApplicantForm();
    }

    public function registerApplicant(Request $request)
    {
        return $this->authUserService->registerApplicant($request->name,$request->email, $request->password);
    }
}
