<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Exports\LaporanExport;
use App\Imports\LaporanImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::query();

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter Kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter Rentang Tanggal (Dari Tanggal - Sampai Tanggal)
        if ($request->filled('start_date')) {
            $query->whereDate('expense_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('expense_date', '<=', $request->end_date);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'expense_date');
        $sortDir = $request->get('sort_dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        // Pagination
        $data = $query->paginate(10)->withQueryString();

        return view('rekap-laporan.index', compact('data'));
    }

    public function importExportPage()
    {
        $totalData = Expense::count();
        $recentData = Expense::orderBy('expense_date', 'desc')->take(5)->get();
        return view('import-export.index', compact('totalData', 'recentData'));
    }

    public function exportExcel(Request $request)
    {
        $filters = $request->only(['search', 'category', 'start_date', 'end_date', 'sort_dir']);
        return Excel::download(new LaporanExport($filters), 'laporan-keuangan-umkm.xlsx');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new LaporanImport, $request->file('file'));

        return back()->with('success', 'Data Excel berhasil diimport!');
    }

    public function exportPdf(Request $request)
    {
        $query = Expense::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('start_date')) {
            $query->whereDate('expense_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('expense_date', '<=', $request->end_date);
        }

        $sortDir = $request->get('sort_dir', 'desc');
        $data = $query->orderBy('expense_date', $sortDir)->get();

        $pdf = Pdf::loadView('reports.pdf', compact('data'));
        return $pdf->download('laporan-keuangan-umkm.pdf');
    }
}