<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            ProductResource::collection(Product::all())->resolve()
        );
    }

    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }
}
