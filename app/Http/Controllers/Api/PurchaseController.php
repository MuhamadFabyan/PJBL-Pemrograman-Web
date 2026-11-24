<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePurchaseRequest;
use App\Models\Expense;
use App\Models\Ingredient;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['ingredient', 'supplier'])
            ->latest('purchase_date')
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $purchases,
        ]);
    }

    public function store(StorePurchaseRequest $request)
    {
        $validated = $request->validated();

        $purchase = DB::transaction(function () use ($validated) {
            $totalPrice = $validated['quantity'] * $validated['unit_price'];

            $purchase = Purchase::create([
                'supplier_id'   => $validated['supplier_id'] ?? null,
                'ingredient_id' => $validated['ingredient_id'],
                'quantity'      => $validated['quantity'],
                'unit_price'    => $validated['unit_price'],
                'total_price'   => $totalPrice,
                'purchase_date' => $validated['purchase_date'],
                'notes'         => $validated['notes'] ?? null,
            ]);

            $ingredient = Ingredient::findOrFail($validated['ingredient_id']);
            $ingredient->increment('stock', $validated['quantity']);
            $ingredient->update(['last_price' => $validated['unit_price']]);

            Expense::create([
                'purchase_id'  => $purchase->id,
                'title'        => 'Pembelian ' . $ingredient->name . ' (' . $validated['quantity'] . ' ' . $ingredient->unit . ')',
                'category'     => 'Bahan Baku',
                'amount'       => $totalPrice,
                'expense_date' => $validated['purchase_date'],
                'description'  => $validated['notes'] ?? 'Otomatis dari transaksi pembelian',
            ]);

            return $purchase->load(['ingredient', 'supplier']);
        });

        return response()->json([
            'status'  => 'success',
            'message' => 'Pembelian berhasil dicatat, stok bertambah & pengeluaran diperbarui',
            'data'    => $purchase,
        ], 201);
    }

    public function show(Purchase $purchase)
    {
        return response()->json([
            'status' => 'success',
            'data'   => $purchase->load(['ingredient', 'supplier', 'expense']),
        ]);
    }

    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'purchase_date' => 'sometimes|required|date',
            'notes'         => 'nullable|string|max:500',
        ]);

        $purchase->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data pembelian diperbarui',
            'data'    => $purchase,
        ]);
    }

    public function destroy(Purchase $purchase)
    {
        DB::transaction(function () use ($purchase) {
            $purchase->ingredient->decrement('stock', $purchase->quantity);
            $purchase->delete();
        });

        return response()->json([
            'status'  => 'success',
            'message' => 'Transaksi pembelian dihapus & stok dikembalikan',
        ]);
    }
}