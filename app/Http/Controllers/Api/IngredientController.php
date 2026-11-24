<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    // Menampilkan semua bahan
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Ingredient::orderBy('name')->get(),
        ], 200);
    }

    // Menambahkan bahan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'stock' => 'nullable|numeric|min:0',
            'unit' => 'required|string|max:50',
            'min_stock' => 'nullable|numeric|min:0',
            'last_price' => 'nullable|numeric|min:0',
        ]);

        $ingredient = Ingredient::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Bahan baku berhasil ditambahkan.',
            'data' => $ingredient,
        ], 201);
    }

    // Menampilkan satu bahan
    public function show(Ingredient $ingredient)
    {
        return response()->json([
            'status' => 'success',
            'data' => $ingredient,
        ], 200);
    }

    // Mengubah bahan
    public function update(Request $request, Ingredient $ingredient)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'category' => 'nullable|string|max:100',
            'stock' => 'nullable|numeric|min:0',
            'unit' => 'sometimes|required|string|max:50',
            'min_stock' => 'nullable|numeric|min:0',
            'last_price' => 'nullable|numeric|min:0',
        ]);

        $ingredient->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data bahan berhasil diperbarui.',
            'data' => $ingredient->fresh(),
        ], 200);
    }

    // Menghapus bahan
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Bahan berhasil dihapus.',
        ], 200);
    }
    public function dashboard()
{
    $ingredients = Ingredient::all();

    return response()->json([
        'status' => 'success',
        'data' => [
            'total_jenis_bahan' => $ingredients->count(),

            'total_stok' => $ingredients->sum('stock'),

            'stok_menipis' => $ingredients->filter(function ($item) {
                return $item->stock <= $item->min_stock;
            })->count(),

            'total_nilai_persediaan' => $ingredients->sum(function ($item) {
                return $item->stock * $item->last_price;
            }),
        ]
    ]);
}
}
