<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContohController extends Controller
{
    public function index()
    {
        $name = "Rifki"; // Buat variabel $name
        $fruits = ['Apel', 'Mangga', 'Pisang', 'Jeruk']; // Buat array $fruits
        return view('contoh', compact('name', 'fruits')); // Kirim variabel $name dan $fruits ke contoh.blade.php
    }
}