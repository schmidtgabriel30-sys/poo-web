<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);

        return $category;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Categoria não encontrada',
            ], 404);
        }

        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Categoria não encontrada',
            ], 404);
        }

        $hasProduct = \App\Models\Product::where('category_id', $category->id)->exists();

        if ($hasProduct) {
            return response()->json([
                'message' => 'Categoria com produtos relacionados',
            ], 422);
        }

        $category->delete();

        return response()->json([
            'message' => 'Categoria excluída',
        ], 204);
    }
}