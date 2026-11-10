<?php

namespace App\Services\Interfaces;

use App\Models\Ticket;

interface AdminTicketServiceInterface
{
    public function storeTicket(array $data): Ticket;

    public function editTicket(Ticket $ticket ,array $data): Ticket;

    public function destroyTicket(Ticket $ticket): void;
}
