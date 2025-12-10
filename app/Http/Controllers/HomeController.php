<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua kategori
        $categories = ProductCategory::whereNull('parent_id')->get();

        // Ambil 8 produk terbaru (sesuai kebutuhan home)
        $products = Product::latest()->take(8)->get();

        return view('home', compact('categories', 'products'));
    }
}
