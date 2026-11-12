<?php

namespace App\Http\Controllers;

use App\Http\Resources\Order\OrderResource;
use App\Services\Interfaces\OrderServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        private OrderServiceInterface $orderService,
    ){}

    public function index(Request $request): JsonResponse
    {
        return response()->json([
            OrderResource::collection($this->orderService->showHistory($request->user()))->resolve()
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $order = $this->orderService->makeOrder($request->user());

        return response()->json([
            'order' => $order->id,
            'message' => 'Order is processed'
        ], 201);
    }
}
