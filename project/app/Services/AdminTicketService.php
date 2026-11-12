<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Interfaces\AdminTicketRepositoryInterface;
use App\Services\Interfaces\AdminTicketServiceInterface;

class AdminTicketService implements AdminTicketServiceInterface
{
    public function __construct(
        private AdminTicketRepositoryInterface $adminTicket,
    ){}

    public function storeTicket(array $data): Product
    {
        return $this->adminTicket->createTicket($data);
    }

    public function editTicket(Product $ticket, array $data): Product
    {
        return $this->adminTicket->updateTicket($ticket, $data);
    }

    public function destroyTicket(Product $ticket): void
    {
        $this->adminTicket->deleteTicket($ticket);
    }
}
