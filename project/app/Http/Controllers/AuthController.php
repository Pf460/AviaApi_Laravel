<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Resources\Auth\UserResource;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthServiceInterface $authService)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        ['token' => $token] = $this->authService->login($data['email'], $data['password']);

        if (!$token) {
            return response()->json([
                'message' => 'error' //заглушка
            ]);
        }

        return response()->json([
            'user_token' => $token
        ]);
    }

    public function signUp(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('avatar'))
        {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = '/storage/' . $path;
        }

        ['token' => $token] = $this->authService->signUp($data);

        if (!$token) {
            return response()->json([
                'message' => 'error' //заглушка
            ]);
        }

        return response()->json([
            'user_token' => $token
        ]);
    }

    public function profile(Request $request): UserResource | JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'user' => new UserResource($user)
        ]);
    }

    public function updateProfile(UpdateProfileRequest $request): UserResource | JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('avatar'))
        {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = '/storage/' . $path;
        }

        $this->authService->updateProfile($request->user(), $data);

        return response()->json([
            'message' => 'data update success'
        ], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->user());

        return response()->json([
            'message' => 'Logout success'
        ], 200);
    }
}
