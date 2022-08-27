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

    public function login(Request $request)
    {
        return $this->authEmployerService->login($request->email, $request->password);
    }
}
