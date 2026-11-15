<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\SignUpAction;
use App\Actions\Auth\UpdateProfileAction;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Resources\Auth\UserResource;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginAction $action): JsonResponse
    {
        $data = $request->validated();

        $token = $action->execute($data['email'], $data['password']);

        return response()->json([
            'user_token' => $token,
        ], 200);
    }

    public function signUp(SignUpRequest $request, SignUpAction $action): JsonResponse
    {
        $data = $request->validated();

        if($request->hasFile('avatar'))
        {
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('avatars'), $fileName);

            $data['avatar'] = 'avatars/' . $fileName;
        }

        $token = $action->execute($data);

        return response()->json([
            'user_token' => $token,
        ], 201);
    }

    public function profile(Request $request): UserResource | JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'user' => new UserResource($user)
        ], 200);
    }

    public function updateProfile(UpdateProfileRequest $request, UpdateProfileAction $action): UserResource | JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('avatar'))
        {
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('avatars'), $fileName);

            $data['avatar'] = 'avatars/' . $fileName;
        }

        $action->execute($request->user() ,$data);

        return response()->json([
            'message' => 'data update successfully'
        ], 200);
    }

    public function logout(Request $request, LogoutAction $action): JsonResponse
    {
        $action->execute($request->user());

        return response()->json([
            'message' => 'logout'
        ], 200);
    }
}
