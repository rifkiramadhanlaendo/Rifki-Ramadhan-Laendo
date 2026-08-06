namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan Halaman Utama (Home)
    public function index() {
        return view('home'); // atau 'index' tergantung nama file view Anda
    }

    // Menampilkan Halaman Daftar Produk
    public function produk() {
        return view('products'); 
    }

    // Menampilkan Halaman Keranjang
    public function keranjang() {
        return view('cart'); 
    }
}