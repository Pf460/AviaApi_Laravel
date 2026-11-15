<?php

namespace App\Actions\Carts;

use App\Exceptions\ForbiddenException;
use App\Models\CartItem;
use App\Models\User;
use App\Policies\CartPolicy;

final class DestroyFromCartAction extends CartPolicy
{
    public function execute(CartItem $cartItem, User $user): void
    {
        if($this->destroyCart($cartItem, $user))
        {
            $cartItem->delete();
        } else {
            throw new ForbiddenException();
        }
    }
}
