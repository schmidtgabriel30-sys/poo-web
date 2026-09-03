<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    public function index()
    {
        return Product::paginate();
    }

    public function store(ProductStoreRequest $request)
    {
        return Product::create($request->validated());
    }

    public function show(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return $product;
    }

    public function update(ProductUpdateRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());
        return $product;
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Produto excluído'], 204);
    }
}