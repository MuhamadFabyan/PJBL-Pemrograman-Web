<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data'   => Ingredient::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'category'   => 'nullable|string|max:100',
            'stock'      => 'nullable|numeric|min:0',
            'unit'       => 'required|string|max:50',
            'min_stock'  => 'nullable|numeric|min:0',
            'last_price' => 'nullable|numeric|min:0',
        ]);

        $ingredient = Ingredient::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Bahan baku berhasil ditambahkan',
            'data'    => $ingredient,
        ], 201);
    }

    public function show(Ingredient $ingredient)
    {
        return response()->json([
            'status' => 'success',
            'data'   => $ingredient->load('purchases'),
        ]);
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $validated = $request->validate([
            'name'       => 'sometimes|required|string|max:255',
            'category'   => 'nullable|string|max:100',
            'stock'      => 'nullable|numeric|min:0',
            'unit'       => 'sometimes|required|string|max:50',
            'min_stock'  => 'nullable|numeric|min:0',
            'last_price' => 'nullable|numeric|min:0',
        ]);

        $ingredient->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data bahan baku diperbarui',
            'data'    => $ingredient,
        ]);
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Bahan baku berhasil dihapus',
        ]);
    }
}