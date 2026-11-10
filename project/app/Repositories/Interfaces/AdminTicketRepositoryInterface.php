<?php

namespace App\Repositories\Interfaces;

use App\Models\Ticket;

interface AdminTicketRepositoryInterface
{
    public function createTicket(array $data): Ticket;

    public function updateTicket(Ticket $ticket, array $data): Ticket;

    public function deleteTicket(Ticket $ticket): void;
}
