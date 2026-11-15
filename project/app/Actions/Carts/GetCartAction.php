<?php

namespace App\Actions\Carts;

use App\Models\CartItem;
use App\Models\User;
use Illuminate\Support\Collection;

final class GetCartAction
{
    public function execute(User $user): Collection
    {
        return CartItem::where('user_id', $user->id)->with('product')->get();
    }
}
