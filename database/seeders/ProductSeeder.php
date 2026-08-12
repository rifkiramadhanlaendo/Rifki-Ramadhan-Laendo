<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->delete();

        $names = [
            1 => ['Smartphone X', 'Laptop Pro', 'Headphone Wireless', 'Smartwatch', 'Kamera Mirrorless', 'Mouse Gaming'],
            2 => ['Kemeja Flanel', 'Kaos Polos', 'Jeans Slim Fit', 'Jaket Hoodie', 'Topi Baseball', 'Sepatu Sneakers'],
            3 => ['Meja Kerja', 'Kursi Ergonomis', 'Lampu Meja', 'Rak Buku', 'Sprei Kasur', 'Panci Set'],
            4 => ['Kopi Robusta', 'Teh Celup', 'Cokelat Batang', 'Keripik Singkong', 'Susu UHT', 'Mie Instan'],
            5 => ['Novel Fiksi', 'Buku Resep', 'Buku Sejarah', 'Pulpen Gel', 'Buku Gambar', 'Penggaris Set']
        ];

        $products = [];
        foreach ($names as $catId => $itemNames) {
            foreach ($itemNames as $index => $name) {
                // Menggunakan gambar placeholder acak yang sesuai untuk produk
                $products[] = [
                    'name' => $name,
                    'category_id' => $catId,
                    'description' => 'Deskripsi lengkap untuk produk ' . $name . ' yang berkualitas tinggi.',
                    'price' => rand(15000, 4500000),
                    'stock' => rand(10, 50),
                    'image' => 'https://picsum.photos/seed/product_' . $catId . '_' . $index . '/200/200',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        DB::table('products')->insert($products);
    }
}