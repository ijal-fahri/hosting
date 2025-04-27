<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    public function updated(Product $product)
    {
        if ($product->stock === 0) {
            $product->status = 'nonaktif';
            $product->save();
        }
    }
}