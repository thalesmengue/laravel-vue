<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    )
    {
    }
    public function login(AuthLoginRequest $request): JsonResponse
    {
        return $this->authService->login($request);
    }

    public function register(AuthRegisterRequest $request): JsonResponse
    {
        return $this->authService->register($request);
    }
}
