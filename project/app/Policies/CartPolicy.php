<?php

namespace App\Policies;

use App\Models\CartItem;
use App\Models\User;

class CartPolicy
{
    public function destroyCart(CartItem $cartItem, User $user): bool
    {
        if($cartItem->user_id === $user->id)
        {
            return true;
        }
        return false;
    }

}
