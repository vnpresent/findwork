<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\authUserService;
use Illuminate\Http\Request;

class AuthUserController extends Controller
{
    protected $authUserService;

    public function __construct(authUserService $authUserService)
    {
        $this->authUserService = $authUserService;
    }

    public function showLoginForm()
    {
        return $this->authUserService->showLoginForm();
    }

    public function login(Request $request)
    {
        return $this->authUserService->login($request->email, $request->password);
    }
}
