<?php

namespace App\Repositories\Interfaces;

use App\Models\Product;

interface AdminTicketRepositoryInterface
{
    public function createTicket(array $data): Product;

    public function updateTicket(Product $ticket, array $data): Product;

    public function deleteTicket(Product $ticket): void;
}
