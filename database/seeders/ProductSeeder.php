<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Laptop Gaming Pro',
                'description' => 'Laptop spek tinggi untuk gaming dan editing video.',
                'stock' => 10,
                'image' => 'laptop.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Smartphone X',
                'description' => 'Smartphone layar jernih baterai tahan lama.',
                'stock' => 25,
                'image' => 'smartphone.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}