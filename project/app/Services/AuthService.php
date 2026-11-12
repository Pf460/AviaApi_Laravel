<?php

namespace App\Services;

use App\Exceptions\InvalidPasswordException;
use App\Models\User;
use App\Enums\UserRole;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    public function __construct(private AuthRepositoryInterface $authRepo)
    {}

    public function login(string $email, string $password): array
    {
        $user = $this->authRepo->findByEmail($email);

        if(!$user || !Hash::check($password, $user->password)) {
            throw new InvalidPasswordException();
        }

        $token = $user->createToken('token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function signUp(array $data): array
    {
        $data['role'] = UserRole::USER->value;

        $user = $this->authRepo->create($data);
        $token = $user->createToken('token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function updateProfile(User $user, array $data): User
    {
        return $this->authRepo->update($user, $data);
    }

    public function logout(User $user): void
    {
        $user->currentAccessToken()->delete();
    }
}
