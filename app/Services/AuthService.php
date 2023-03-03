<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login($data): JsonResponse
    {
        $credentials = request()->only(['email', 'password']);
        $token = Auth::attempt($credentials);
        $user = Auth::user();

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'user' => $user,
            'authorization' => [
                'token' => $token,
            ]
        ]);
    }

    public function register($data): JsonResponse
    {
        $user = User::create([
            'name' => $data->name,
            'last_name' => $data->last_name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);

        $token = Auth::login($user);

        return response()->json([
            'success' => true,
            'user' => $user,
            'authorization' => [
                'token' => $token,
            ]
        ]);
    }
}
