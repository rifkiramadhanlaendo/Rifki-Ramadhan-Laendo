<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() { /* Tampil semua produk (CRUD Read) */ }
    public function create() { /* Form tambah produk */ }
    public function store(Request $request) { /* Simpan produk baru */ }
    public function show($id) { /* Detail satu produk */ }
    public function edit($id) { /* Form edit produk */ }
    public function update(Request $request, $id) { /* Proses update produk */ }
    public function destroy($id) { /* Hapus produk */ }
}