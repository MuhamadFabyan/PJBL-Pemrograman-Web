<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Models\Expense;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::latest('expense_date')->get();

        $summary = [
            'total_transaksi'   => Expense::count(),
            'total_pengeluaran' => Expense::sum('amount'),
            'jenis_bahan'       => Ingredient::count(),
            'update_terakhir'   => Expense::latest('updated_at')->value('updated_at'),
        ];

        return response()->json([
            'status'  => 'success',
            'summary' => $summary,
            'data'    => $expenses,
        ]);
    }

    public function store(StoreExpenseRequest $request)
    {
        $expense = Expense::create($request->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'Pengeluaran berhasil dicatat',
            'data'    => $expense,
        ], 201);
    }

    public function show(Expense $expense)
    {
        return response()->json([
            'status' => 'success',
            'data'   => $expense->load('purchase'),
        ]);
    }

    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'title'        => 'sometimes|required|string|max:255',
            'category'     => 'sometimes|required|string|max:100',
            'amount'       => 'sometimes|required|numeric|min:0',
            'expense_date' => 'sometimes|required|date',
            'description'  => 'nullable|string',
        ]);

        $expense->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data pengeluaran diperbarui',
            'data'    => $expense,
        ]);
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data pengeluaran dihapus',
        ]);
    }
}