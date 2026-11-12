<?php

namespace App\Services;

use App\Exceptions\ForbiddenException;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Services\Interfaces\CartServiceInterface;
use Illuminate\Support\Collection;

class CartService implements CartServiceInterface
{
    public function __construct(
        private CartRepositoryInterface $cartRepo,
    ){}

    public function addToCart(Product $product, User $user): CartItem
    {
        return $this->cartRepo->createCartItem($product, $user);
    }

    public function getCartItems(User $user): Collection
    {
        return $this->cartRepo->findByUser($user);
    }

    public function removeFromCart(CartItem $cartItem, User $user): void
    {
        if($cartItem->user_id !== $user->id)
        {
            throw new ForbiddenException();
        }

        $this->cartRepo->deleteCartItem($cartItem);
    }
}
