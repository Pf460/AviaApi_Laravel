<?php

namespace App\Actions\Admins;

use App\Models\Product;

final class DestroyProductAction
{
    public function execute(Product $product): void
    {
        $product->delete();
    }
}
