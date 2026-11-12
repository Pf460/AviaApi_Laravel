<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreTicketRequest;
use App\Http\Requests\Admin\UpdateTicketRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Services\Interfaces\AdminTicketServiceInterface;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function __construct(
        private AdminTicketServiceInterface $adminService
    ){}

    public function index(): JsonResponse
    {
        return response()->json(
            ProductResource::collection(Product::all())->resolve()
        );
    }

    public function show(Product $ticket): ProductResource
    {
        return new ProductResource($ticket);
    }

    public function store(StoreTicketRequest $request): JsonResponse
    {
        $data = $request->validated();
        $ticket = $this->adminService->storeTicket($data);
        $id = $ticket['id'];

        return response()->json([
            'id' => $id,
            'message' => 'Product added'
        ]);
    }

    public function edit(UpdateTicketRequest $request, Product $ticket): ProductResource | JsonResponse
    {
        $data = $request->validated();
        $edit = $this->adminService->editTicket($ticket, $data);

        return new ProductResource($edit);
    }

    public function destroy(Product $ticket): JsonResponse
    {
        $this->adminService->destroyTicket($ticket);

        return response()->json([
            'message' => 'Product removed',
        ]);
    }
}
