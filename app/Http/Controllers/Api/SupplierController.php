<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data'   => Supplier::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $supplier = Supplier::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Supplier berhasil ditambahkan',
            'data'    => $supplier,
        ], 201);
    }

    public function show(Supplier $supplier)
    {
        return response()->json([
            'status' => 'success',
            'data'   => $supplier->load('purchases'),
        ]);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name'    => 'sometimes|required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $supplier->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data supplier diperbarui',
            'data'    => $supplier,
        ]);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Supplier berhasil dihapus',
        ]);
    }
}