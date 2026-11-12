<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Collection;

class OrderRepository implements OrderRepositoryInterface
{
    public function createOrderForUser(User $user, float $totalPrice): Order
    {
        return Order::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice,
        ]);
    }

    public function attachItemToOrder(Order $order, Product $product, float $price): OrderItem
    {
        return OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'price' => $price,
        ]);
    }

    public function findByUser(User $user): Collection
    {
        return Order::where('user_id', $user->id)->with('items')->get();
    }
}
