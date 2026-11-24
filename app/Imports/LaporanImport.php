<?php

namespace App\Imports;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LaporanImport implements ToModel, WithHeadingRow
{
    public function model(array $row): Model|array|null
    {
        // Lewati jika baris kosong (tidak ada judul/title)
        $title = $row['judul'] ?? $row['title'] ?? null;
        if (!$title) {
            return null;
        }

        return new Expense([
            'title'        => $title,
            'category'     => $row['kategori'] ?? $row['category'] ?? 'Operasional',
            'amount'       => $row['nominal'] ?? $row['amount'] ?? 0,
            'expense_date' => $row['tanggal'] ?? $row['expense_date'] ?? now()->format('Y-m-d'),
            'description'  => $row['keterangan'] ?? $row['description'] ?? null,
        ]);
    }
}