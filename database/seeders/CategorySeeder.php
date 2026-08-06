<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Elektronik', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fashion Pria', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fashion Wanita', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}