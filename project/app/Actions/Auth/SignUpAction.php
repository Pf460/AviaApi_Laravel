<?php

namespace App\Actions\Auth;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Validation\ValidationException;

final class SignUpAction
{
    public function execute(array $data): string
    {
        $data['role'] = UserRole::USER->value;

        $user = User::query()->create($data);
        $token = $user->createToken('token')->plainTextToken;

        return $token;
    }
}
