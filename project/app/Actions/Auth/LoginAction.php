<?php

namespace App\Actions\Auth;

use App\Exceptions\InvalidCanditionsException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class LoginAction
{
    public function execute(string $email, string $password): string
    {
        $user = User::where('email', $email)->first();

        if(!$user || !Hash::check($password, $user->password)) {
            throw new InvalidCanditionsException();
        }

        $token = $user->createToken('token')->plainTextToken;

        return $token;
    }
}
