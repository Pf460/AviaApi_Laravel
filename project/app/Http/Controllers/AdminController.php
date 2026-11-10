<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreTicketRequest;
use App\Http\Requests\Admin\UpdateTicketRequest;
use App\Http\Resources\Ticket\TicketResource;
use App\Models\Ticket;
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
            TicketResource::collection(Ticket::all())->resolve()
        );
    }

    public function show(Ticket $ticket): TicketResource
    {
        return new TicketResource($ticket);
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

    public function edit(UpdateTicketRequest $request, Ticket $ticket): TicketResource | JsonResponse
    {
        $data = $request->validated();
        $edit = $this->adminService->editTicket($ticket, $data);

        return new TicketResource($edit);
    }

    public function destroy(Ticket $ticket): JsonResponse
    {
        $this->adminService->destroyTicket($ticket);

        return response()->json([
            'message' => 'Product removed',
        ]);
    }
}
