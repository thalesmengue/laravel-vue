<?php

namespace App\Repositories;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

    public function update(array $data, $id): array
    {
        $product = Product::query()
            ->findOrFail($id);

        if (request()->hasFile('image')) {
            $path = request()->image->store('products', 'public');

            File::delete(public_path('storage/' . $product->image));

            return [
                'success' => $product->update([
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'image' => $path
                ]),
                'product' => $product
            ];
        }

        return [
            'success' => $product->update([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'image' => $product->image
            ]),
            'product' => $product
        ];
    }

    public function delete($id): array
    {
        $product = Product::query()
            ->findOrFail($id);

        File::delete(public_path('storage/' . $product->image));

        return [
            'success' => $product->delete(),
            'product' => $product
        ];
    }
}
