<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return $category;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            // 404 Not Found
            return response()->json([
                'message' => 'Categoria não encontrada',
            ], 404);
        }

        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            // 404 Not Found
            return response()->json([
                'message' => 'Categoria não encontrada',
            ], 404);
        }

        $category->name = $request->name ?? $category->name;
        $category->description = $request->description ?? $category->description;
        $category->save();

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            // 404 Not Found
            return response()->json([
                'message' => 'Categoria não encontrada',
            ], 404);
        }

        $hasProduct = \App\Models\Product::where('category_id', $category->id)->exists();

        if ($hasProduct) {
            // 422 Unprocessable Entity
            return response()->json([
                'message' => 'Categoria com produtos relacionados',
            ], 422);
        }

        $category->delete();

        // 204 No Content
        return response()->json([
            'message' => 'Categoria excluída',
        ], 204);
    }
}