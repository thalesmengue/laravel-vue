<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductRepository $productRepository
    )
    {
    }

    public function index(): JsonResponse
    {
        $products = $this->productRepository->all();

        return response()->json([
            'success' => true,
            'products' => $products,
        ]);
    }

    public function store(ProductStoreRequest $request): JsonResponse
    {
        $product = $this->productRepository->create($request->all());

        return response()->json([
            'success' => true,
            'product' => $product,
        ]);
    }

    public function show($id): JsonResponse
    {
        $product = $this->productRepository->find($id);

        return response()->json([
            'success' => true,
            'product' => $product,
        ]);
    }

    public function edit(ProductUpdateRequest $request, $id): JsonResponse
    {
            $updated = $this->productRepository->update($request->all(), $id);

            return response()->json([
                'success' => $updated['success'],
                'product' => $updated['product'],
                ], $updated['success'] ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    public function destroy($id): JsonResponse
    {
        $product = Product::query()
            ->findOrFail($id)
            ->delete();

        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }
}
