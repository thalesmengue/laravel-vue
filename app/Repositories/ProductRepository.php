<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class ProductRepository implements ProductRepositoryInterface
{
    public function all(): Collection
    {
        return Product::all()
            ->where('user_id', auth()->id());
    }

    public function find($id): Builder|array|Collection|Model
    {
        return Product::query()
            ->findOrFail($id);
    }

    public function create(array $data): Model
    {
        return Product::query()
            ->create([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'image' => $data['image']->store('products', 'public')
            ]);
    }

    public function update(array $data, $id)
    {
        if (request()->hasFile('image')) {
            $data['image'] = request()->image->store('products', 'public');
        }

        return Product::query()
            ->findOrFail($id)
            ->update($data);
    }

    public function delete($id)
    {
        $product = Product::query()
            ->findOrFail($id);

        return $product->delete();
    }
}
