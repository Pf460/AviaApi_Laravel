<?php

namespace App\Repositories\Interfaces;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function createOrderForUser(User $user, float $totalPrice): Order;

    public function attachItemToOrder(Order $order, Product $product, float $price): OrderItem;

    public function findByUser(User $user): Collection;

}
