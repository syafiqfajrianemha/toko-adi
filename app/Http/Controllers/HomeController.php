<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        $categories = Category::latest()->get();
        return view('user.home.index', compact('products', 'categories'));
    }

    public function detailProduk($id)
    {
        $product = Product::findOrFail($id);
        return view('user.home.detail', compact('product'));
    }
}
