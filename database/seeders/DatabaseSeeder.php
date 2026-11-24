<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::create([
            'name'    => 'Toko Bahan Kue Makmur',
            'phone'   => '081234567890',
            'address' => 'Pasar Induk Blok A No. 12',
        ]);

        Supplier::create([
            'name'    => 'CV Sembako Jaya',
            'phone'   => '085678901234',
            'address' => 'Jl. Raya Industri No. 45',
        ]);

        Ingredient::create([
            'name'       => 'Tepung Terigu Protein Sedang',
            'category'   => 'Bahan Kering',
            'stock'      => 25,
            'unit'       => 'kg',
            'min_stock'  => 5,
            'last_price' => 12000,
        ]);

        Ingredient::create([
            'name'       => 'Gula Pasir Putih',
            'category'   => 'Bahan Kering',
            'stock'      => 15,
            'unit'       => 'kg',
            'min_stock'  => 5,
            'last_price' => 16500,
        ]);

        Ingredient::create([
            'name'       => 'Minyak Goreng Kemasan',
            'category'   => 'Bahan Cair',
            'stock'      => 10,
            'unit'       => 'liter',
            'min_stock'  => 3,
            'last_price' => 15000,
        ]);
    }
}