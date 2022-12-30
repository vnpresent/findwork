<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService\authEmployerService;
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
        return $this->authEmployerService->loginEmployer($request->email, $request->password, $request->remember);
    }

    public function showRegisterEmployerForm()
    {
        return $this->authEmployerService->showRegisterEmployerForm();
    }

    public function registerEmployer(Request $request)
    {
        return $this->authEmployerService->registerEmployer($request->name, $request->email, $request->password);
    }

    public function logout()
    {
        return $this->authEmployerService->logout();
    }

    public function showUpdateProfileForm()
    {
        return $this->authEmployerService->showUpdateProfileForm();
    }

    public function updateProfile(Request $request)
    {
        return $this->authEmployerService->updateProfile($request->name, $request->description, $request->address);
    }

    public function updateAvatar(Request $request)
    {
        return $this->authEmployerService->updateAvatar($request->file('avatar'));
    }

    public function showChangePasswordForm()
    {
        return $this->authEmployerService->showChangePasswordForm();
    }

    public function changePassword(Request $request)
    {
        return $this->authEmployerService->changePassword($request->password, $request->new_password, $request->new_password1);
    }
}
