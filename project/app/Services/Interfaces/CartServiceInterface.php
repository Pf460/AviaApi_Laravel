<?php

namespace App\Services\Interfaces;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Collection;

interface CartServiceInterface
{
    public function addToCart(Product $product, User $user): CartItem;

    public function getCartItems(User $user): Collection;

    public function removeFromCart(CartItem $cartItem, User $user): void;
}
