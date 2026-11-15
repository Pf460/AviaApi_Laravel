<?php

namespace App\Actions\Admins;

use App\Models\Product;

final class UpdateProductAction
{
    public function execute(Product $product, array $data): Product
    {
        $product->update($data);
        return $product->refresh();
    }
}
