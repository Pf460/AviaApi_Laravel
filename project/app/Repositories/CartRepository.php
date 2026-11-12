<?php

namespace App\Repositories;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Support\Collection;

class CartRepository implements CartRepositoryInterface
{
    public function findByUser(User $user): Collection
    {
        return CartItem::where('user_id', $user->id)->with('product')->get();
    }

    public function createCartItem(Product $product, User $user): CartItem
    {
        return CartItem::create([
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);
    }

    public function deleteCartItem(CartItem $cartItem): void
    {
        $cartItem->delete();
    }

    public function deleteAllCartItems(User $user): void
    {
        CartItem::where('user_id', $user->id)->delete();
    }
}
