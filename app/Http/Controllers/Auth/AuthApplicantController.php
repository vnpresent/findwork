<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService\authApplicantService;
use Illuminate\Http\Request;

class AuthApplicantController extends Controller
{
    protected $authApplicantService;

    public function __construct(authApplicantService $authApplicantService)
    {
        $this->authApplicantService = $authApplicantService;
    }

    public function showLoginApplicantForm()
    {
        return $this->authApplicantService->showLoginApplicantForm();
    }

    public function loginApplicant(Request $request)
    {
        return $this->authApplicantService->loginApplicant($request->email, $request->password, $request->has('remember'));
    }

    public function showRegisterApplicantForm()
    {
        return $this->authApplicantService->showRegisterApplicantForm();
    }

    public function registerApplicant(Request $request)
    {
        return $this->authApplicantService->registerApplicant($request->name, $request->email, $request->password);
    }

    public function logout()
    {
        return $this->authApplicantService->logout();
    }

    public function showUpdateProfileForm()
    {
        return $this->authApplicantService->showUpdateProfileForm();
    }

    public function updateProfile(Request $request)
    {
        return $this->authApplicantService->updateProfile($request->name, $request->input('phone', ''), $request->birthday, $request->address, $request->password, $request->new_password, $request->new_password1);
    }
}
