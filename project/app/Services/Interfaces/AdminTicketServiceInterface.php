<?php

namespace App\Services\Interfaces;

use App\Models\Product;

interface AdminTicketServiceInterface
{
    public function storeTicket(array $data): Product;

    public function editTicket(Product $ticket , array $data): Product;

    public function destroyTicket(Product $ticket): void;
}
