<?php

namespace App\Http\Controllers;

use App\Actions\Admins\DestroyProductAction;
use App\Actions\Admins\StoreProductAction;
use App\Actions\Admins\UpdateProductAction;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Http\Resources\Admin\AdminProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{

    public function index(): JsonResponse
    {
        return response()->json(
            AdminProductResource::collection(Product::all())->resolve()
        );
    }

    public function show(Product $product): AdminProductResource
    {
        return new AdminProductResource($product);
    }

    public function store(StoreProductRequest $request, StoreProductAction $action): JsonResponse
    {
        $data = $request->validated();
        $product = $action->execute($data);

        return response()->json([
            'id' => $product['id'],
            'message' => 'Product added'
        ], 201);
    }

    public function update(UpdateProductRequest $request, Product $product, UpdateProductAction $action): AdminProductResource
    {
        $data = $request->validated();
        $edit = $action->execute($product, $data);

        return new AdminProductResource($edit);
    }

    public function destroy(Product $product, DestroyProductAction $action): JsonResponse
    {
        $action->execute($product);

        return response()->json([
            'message' => 'Product removed',
        ], 200);
    }
}
