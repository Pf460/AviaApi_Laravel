<?php

namespace App\Http\Controllers;

use App\Actions\Carts\AddToCartAction;
use App\Actions\Carts\DestroyFromCartAction;
use App\Actions\Carts\GetCartAction;
use App\Http\Resources\Cart\CartResource;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(Request $request, GetCartAction $action): JsonResponse
    {
        return response()->json(
            CartResource::collection($action->execute($request->user()))->resolve()
        );
    }

    public function add(Request $request, Product $product, AddToCartAction $action): JsonResponse
    {
        $action->execute($request->user(), $product);

        return response()->json([
            'message' => 'Product add to cart',
        ], 201);
    }

    public function destroy(Request $request, CartItem $cartItem, DestroyFromCartAction $action): JsonResponse
    {
        $action->execute($cartItem, $request->user());
        return response()->json([
            'message' => 'Item removed from cart'
        ], 200);
    }
}
