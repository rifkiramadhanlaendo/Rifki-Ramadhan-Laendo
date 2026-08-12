<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->delete();

        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Elektronik'],
            ['id' => 2, 'name' => 'Pakaian'],
            ['id' => 3, 'name' => 'Perabotan Rumah'],
            ['id' => 4, 'name' => 'Makanan & Minuman'],
            ['id' => 5, 'name' => 'Buku & Alat Tulis'],
        ]);
    }
}