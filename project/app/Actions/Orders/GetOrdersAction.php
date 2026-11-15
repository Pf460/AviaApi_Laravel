<?php

namespace App\Actions\Orders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Collection;

final class GetOrdersAction
{
    public function execute(User $user): Collection
    {
        return Order::where('user_id', $user->id)->with('items')->get();
    }
}
