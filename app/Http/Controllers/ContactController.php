<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContohController extends Controller
{
    public function index()
    {
        $name = "Rifki";
        return view('contoh', compact('name'));
    }
}