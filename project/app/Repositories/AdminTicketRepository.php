<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\AdminTicketRepositoryInterface;

class AdminTicketRepository implements AdminTicketRepositoryInterface
{
    public function createTicket(array $data): Product
    {
        return Product::query()->create($data);
    }

    public function updateTicket(Product $ticket, array $data): Product
    {
        $ticket->update($data);
        return $ticket->refresh();
    }

    public function deleteTicket(Product $ticket): void
    {
        $ticket->delete();
    }
}
