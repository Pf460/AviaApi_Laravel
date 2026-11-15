<?php

namespace App\Http\Controllers;

use App\Actions\Orders\GetOrdersAction;
use App\Actions\Orders\StoreOrderAction;
use App\Http\Resources\Order\OrderResource;
use App\Services\Interfaces\OrderServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request, GetOrdersAction $action): JsonResponse
    {
        return response()->json([
            OrderResource::collection($action->execute($request->user()))->resolve()
        ], 200);
    }

    public function store(Request $request, StoreOrderAction $action): JsonResponse
    {
        $action->execute($request->user());

        return response()->json([
            'order' => $order->id,
            'message' => 'Order is processed'
        ], 201);
    }
}
