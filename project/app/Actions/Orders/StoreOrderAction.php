<?php

namespace App\Actions\Orders;

use App\Exceptions\CartEmptyException;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final class StoreOrderAction
{
    public function execute(User $user): Order
    {
        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty())
        {
            throw new CartEmptyException();
        }

        return DB::transaction(function () use ($user, $cartItems) {
            $totalPrice = $cartItems->sum(function ($item) {
                return $item->product->price;
            });
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
            ]);
            foreach ($cartItems as $cartItem)
            {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'price' => $cartItem->product->price,
                ]);
            }
            CartItem::where('user_id', $user->id)->delete();

            return $order->refresh();
        });
    }
}
