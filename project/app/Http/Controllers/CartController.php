<?php

namespace App\Http\Controllers;

use App\Http\Resources\Cart\CartResource;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use App\Services\Interfaces\CartServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        private CartServiceInterface $cartService,
    ){}

    public function index(Request $request): JsonResponse
    {
        return response()->json(
            CartResource::collection($this->cartService->getCartItems($request->user()))->resolve()
        );
    }

    public function add(Request $request, Product $product): JsonResponse
    {
        $this->cartService->addToCart($product, $request->user());

        return response()->json([
            'message' => 'Product add to cart',
        ], 201);
    }

    public function destroy(Request $request, CartItem $cartItem): JsonResponse
    {
        $this->cartService->removeFromCart($cartItem, $request->user());
        return response()->json([
            'message' => 'Item removed from cart'
        ]);
    }
}
