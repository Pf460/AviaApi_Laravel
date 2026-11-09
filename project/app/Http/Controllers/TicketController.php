<?php

namespace App\Http\Controllers;

use App\Http\Resources\Ticket\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
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
}
