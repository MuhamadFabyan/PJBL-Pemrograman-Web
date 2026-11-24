<?php

namespace App\Exports;

use App\Models\Expense;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection(): Collection
    {
        $query = Expense::select('id', 'title', 'category', 'amount', 'expense_date', 'description');

        if (!empty($this->filters['search'])) {
            $query->where('title', 'like', '%' . $this->filters['search'] . '%');
        }

        if (!empty($this->filters['category'])) {
            $query->where('category', $this->filters['category']);
        }

        if (!empty($this->filters['start_date'])) {
            $query->whereDate('expense_date', '>=', $this->filters['start_date']);
        }

        if (!empty($this->filters['end_date'])) {
            $query->whereDate('expense_date', '<=', $this->filters['end_date']);
        }

        $sortDir = $this->filters['sort_dir'] ?? 'desc';
        $query->orderBy('expense_date', $sortDir);

        return $query->get();
    }

    public function headings(): array
    {
        return ['ID', 'Judul', 'Kategori', 'Nominal', 'Tanggal', 'Keterangan'];
    }
}