<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthEmployerService;
use Illuminate\Http\Request;

class AuthEmployerController extends Controller
{
    protected $authEmployerService;
    public function __construct(AuthEmployerService $authEmployerService)
    {
        $this->authEmployerService = $authEmployerService;
    }

    public function showLoginForm()
    {
        return $this->authEmployerService->showLoginForm();
    }

    public function login(Request $request)
    {
        return $this->authEmployerService->login($request->email, $request->password);
    }
}
