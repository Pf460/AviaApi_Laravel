<?php

namespace App\Actions\Admins;

use App\Models\Product;

final class StoreProductAction
{
    public function execute(array $data): Product
    {
        return Product::query()->create($data);
    }
}
