namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel terlebih dahulu (opsional) agar tidak duplikat saat seeding ulang
        Product::truncate();

        $products = [
            ['name' => 'Laptop Gaming Pro', 'description' => 'Spesifikasi gahar untuk kerja dan gaming berat.', 'stock' => 10],
            ['name' => 'Smartphone X', 'description' => 'Kamera jernih dengan baterai tahan seharian.', 'stock' => 15],
            ['name' => 'Headphone Bluetooth', 'description' => 'Suara jernih bass mantap anti bising.', 'stock' => 25],
            ['name' => 'Smartwatch Sport', 'description' => 'Pantau kesehatan dan aktivitas olahraga harian.', 'stock' => 20],
            ['name' => 'Keyboard Mechanical RGB', 'description' => 'Sensasi mengetik nyaman dengan lampu LED RGB.', 'stock' => 30],
            ['name' => 'Mouse Wireless Ergonomis', 'description' => 'Nyaman digunakan lama dan bebas kabel.', 'stock' => 40],
            ['name' => 'Monitor LED 24 Inch', 'description' => 'Resolusi Full HD tajam untuk desain dan kerja.', 'stock' => 12],
            ['name' => 'External SSD 512GB', 'description' => 'Transfer data super cepat dan portabel.', 'stock' => 18],
            ['name' => 'Tas Ransel Laptop', 'description' => 'Anti air dengan slot khusus laptop dan gadget.', 'stock' => 35],
            ['name' => 'Power Bank 20000mAh', 'description' => 'Kapasitas besar mendukung fast charging.', 'stock' => 22],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}