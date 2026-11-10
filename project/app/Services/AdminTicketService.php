<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\Interfaces\AdminTicketRepositoryInterface;
use App\Services\Interfaces\AdminTicketServiceInterface;

class AdminTicketService implements AdminTicketServiceInterface
{
    public function __construct(
        private AdminTicketRepositoryInterface $adminTicket,
    ){}

    public function storeTicket(array $data): Ticket
    {
        return $this->adminTicket->createTicket($data);
    }

    public function editTicket(Ticket $ticket, array $data): Ticket
    {
        return $this->adminTicket->updateTicket($ticket, $data);
    }

    public function destroyTicket(Ticket $ticket): void
    {
        $this->adminTicket->deleteTicket($ticket);
    }
}
