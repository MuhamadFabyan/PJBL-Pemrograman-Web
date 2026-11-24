<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;
use Carbon\Carbon;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title' => 'Pembelian Biji Kopi Arabika 5kg', 'category' => 'Bahan Baku', 'amount' => 650000, 'description' => 'Stok kopi mingguan'],
            ['title' => 'Gula Aren Cair 10 Liter', 'category' => 'Bahan Baku', 'amount' => 280000, 'description' => 'Supplier langganan'],
            ['title' => 'Susu UHT Full Cream 2 Dus', 'category' => 'Bahan Baku', 'amount' => 420000, 'description' => 'Stok minuman'],
            ['title' => 'Cup Plastik & Tutup (500 pcs)', 'category' => 'Kemasan', 'amount' => 225000, 'description' => 'Kemasan take away'],
            ['title' => 'Token Listrik Kedai', 'category' => 'Operasional', 'amount' => 500000, 'description' => 'Listrik bulanan'],
            ['title' => 'Gas LPG 12kg (2 Tabung)', 'category' => 'Operasional', 'amount' => 440000, 'description' => 'Kebutuhan dapur'],
            ['title' => 'Ayam Fillet Dada 10kg', 'category' => 'Bahan Baku', 'amount' => 480000, 'description' => 'Menu ayam geprek'],
            ['title' => 'Minyak Goreng & Bumbu Dapur', 'category' => 'Bahan Baku', 'amount' => 310000, 'description' => 'Belanja pasar pagi'],
            ['title' => 'Paper Bowl & Sendok Plastik', 'category' => 'Kemasan', 'amount' => 195000, 'description' => 'Kemasan makanan'],
            ['title' => 'Biaya Iklan Instagram Ads', 'category' => 'Pemasaran', 'amount' => 150000, 'description' => 'Promo akhir pekan'],
            ['title' => 'Air Galon & Es Batu Kristal', 'category' => 'Operasional', 'amount' => 120000, 'description' => 'Kebutuhan harian'],
            ['title' => 'Bubuk Matcha & Cokelat Premium', 'category' => 'Bahan Baku', 'amount' => 340000, 'description' => 'Varian minuman non-kopi'],
        ];

        foreach ($items as $index => $item) {
            Expense::create([
                'title'        => $item['title'],
                'category'     => $item['category'],
                'amount'       => $item['amount'],
                'expense_date' => Carbon::now()->subDays(12 - $index)->format('Y-m-d'),
                'description'  => $item['description'],
            ]);
        }
    }
}