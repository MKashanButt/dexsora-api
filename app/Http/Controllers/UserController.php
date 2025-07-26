<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(RegisterUserRequest $request): JsonResponse
    {
        try {
            $validatedRequest = $request->validated();

            $validatedRequest["password"] = bcrypt($validatedRequest["password"]);

            $user = User::create($validatedRequest);

            return response()->json([
                'user' => $user->only('id', 'name', 'email')
            ], 201)->withCookie(
                'sanctum_token',
                $user->createToken('auth')->plainTextToken,
                config('sanctum.expiration'),
                '/',
                null,
                true,
                true,
                false,
                'Lax'
            );
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'User creation failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(LoginUserRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $user = User::where('email', $validated['email'])->first();

            if (!Hash::check($validated['password'], $user->password)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid credentials'
                ], 401);
            }

            $token = $user->createToken('auth')->plainTextToken;

            return response()->json([
                'user' => $user->only('id', 'name', 'email')
            ])->withCookie(
                'sanctum_token',
                $token,
                config('sanctum.expiration'),
                '/',
                null,
                true,
                true,
                false,
                'Lax'
            );
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
