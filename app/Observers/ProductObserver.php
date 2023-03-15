<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductObserver
{
    public function creating(Product $product): void
    {
        $product->user_id = auth()->id();
    }
}
