<?php

namespace App\Actions\Carts;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;

final class AddToCartAction
{
    public function execute(User $user, Product $product): CartItem
    {
        return CartItem::create([
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);
    }
}
