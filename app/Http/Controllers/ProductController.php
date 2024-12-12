<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Traes todos los productos
        return view('home', compact('products'));
    }
}
