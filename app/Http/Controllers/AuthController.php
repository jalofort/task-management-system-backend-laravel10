<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\Auth\AuthService;

class AuthController extends Controller
{

    public function __construct(protected AuthService $authService)
    {
    }

    public function login(LoginRequest $request)
    {
        return $this->authService->login(
            $request->validated('email'),
            $request->validated('password')
        );
    }

    public function register(RegisterRequest $request)
    {
        return $this->authService->register(
            $request->validated('firstName'),
            $request->validated('lastName'),
            $request->validated('email'),
            $request->validated('password')
        );
    }
}
