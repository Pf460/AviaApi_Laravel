<?php

namespace App\Services\Interfaces;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Collection;

interface OrderServiceInterface
{
    public function makeOrder(User $user): Order;

    public function showHistory(User $user): Collection;
}
