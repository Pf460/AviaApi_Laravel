<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface AuthServiceInterface
{
    public function login(string $email, string $password): array;

    public function signUp(array $data): array;

    public function updateProfile(User $user, array $data): User;

    public function logout(User $user): void;
}
