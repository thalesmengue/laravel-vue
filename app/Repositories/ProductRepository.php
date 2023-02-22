<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function all(): Collection
    {
        return Product::all();
    }

    public function find($id): Collection
    {
        return Product::query()
            ->findOrFail($id);
    }

    public function create(array $data): Collection
    {
        return Product::create($data);
    }

    public function update(array $data, $id): bool
    {
        return Product::query()
            ->findOrFail($id)
            ->update($data);
    }

    public function delete($id): bool
    {
        return Product::query()
            ->findOrFail($id)
            ->delete();
    }
}
