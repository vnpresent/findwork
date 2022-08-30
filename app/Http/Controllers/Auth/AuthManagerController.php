<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\authManagerService;
use Illuminate\Http\Request;

class AuthManagerController extends Controller
{
    protected $authManagerService;

    public function __construct(authManagerService $authManagerService)
    {
        $this->authManagerService = $authManagerService;
    }

    public function showLoginForm()
    {
        return $this->authManagerService->showLoginManagerForm();
    }

    public function login(Request $request)
    {
        return $this->authManagerService->loginManager($request->email, $request->password, $request->remember);
    }
}
