<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Menampilkan daftar transaksi masuk
    public function index()
    {
        // return view('admin.transactions.index');
    }

    // Mengubah status transaksi (misal: Pending jadi Diproses/Selesai)
    public function updateStatus(Request $request, $id)
    {
        // Logic update status transaksi
    }
}