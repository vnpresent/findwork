<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthManagerService;
use Illuminate\Http\Request;

class AuthManagerController extends Controller
{
    protected $authManagerService;

    public function __construct(AuthManagerService $authManagerService)
    {
        $this->authManagerService = $authManagerService;
    }

    public function showLoginForm()
    {
        return $this->authManagerService->showLoginForm();
    }

    public function login(Request $request)
    {
        return $this->authManagerService->login($request->email, $request->password);
    }
}
