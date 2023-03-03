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

    public function updating(Product $product): void
    {
        if (request()->hasFile('image')) {
            File::delete(public_path('storage/' . $product->image));
        }
    }

    public function deleting(Product $product): void
    {
        File::delete(public_path('storage/' . $product->image));
    }
}
