<?php

namespace App\Repositories\Interfaces;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Collection;

interface CartRepositoryInterface
{
    public function findByUser(User $user): Collection;

    public function createCartItem(Product $product, User $user): CartItem;

    public function deleteCartItem(CartItem $cartItem): void;

    public function deleteAllCartItems(User $user): void;
}
