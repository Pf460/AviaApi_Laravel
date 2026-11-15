<?php

namespace App\Actions\Auth;

use App\Models\User;

final class UpdateProfileAction
{
    public function execute(User $user, array $data): User
    {
        $user->update($data);
        return $user->refresh();
    }

}
