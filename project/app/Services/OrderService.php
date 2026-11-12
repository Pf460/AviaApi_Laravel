<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Interfaces\OrderServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{
    public function __construct(
        private OrderRepositoryInterface $orderRepo,
        private CartRepositoryInterface $cartRepo,
    ){}

    public function makeOrder(User $user): Order
    {
        $cartItems = $this->cartRepo->findByUser($user);

//        if ($cartItems->isEmpty()) {
//
//        }

        return DB::transaction(function () use ($user, $cartItems) {
            $total = $cartItems->sum(function ($item) {
                return $item->product->price;
            });
            $order = $this->orderRepo->createOrderForUser($user, $total);

            foreach ($cartItems as $cartItem)
            {
                $this->orderRepo->attachItemToOrder($order, $cartItem->product, $cartItem->product->price);
            }

            $this->cartRepo->deleteAllCartItems($user);

            return $order->refresh();
        });
    }

    public function showHistory(User $user): Collection
    {
        return $this->orderRepo->findByUser($user);
    }
}
