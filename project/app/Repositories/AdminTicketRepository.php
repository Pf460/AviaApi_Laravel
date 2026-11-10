<?php

namespace App\Repositories;

use App\Models\Ticket;
use App\Repositories\Interfaces\AdminTicketRepositoryInterface;

class AdminTicketRepository implements AdminTicketRepositoryInterface
{
    public function createTicket(array $data): Ticket
    {
        return Ticket::query()->create($data);
    }

    public function updateTicket(Ticket $ticket, array $data): Ticket
    {
        $ticket->update($data);
        return $ticket->refresh();
    }

    public function deleteTicket(Ticket $ticket): void
    {
        $ticket->delete();
    }
}
