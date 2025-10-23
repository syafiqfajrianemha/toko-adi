<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::latest()->get();

        if (request()->ajax()) {
            return view('user.partials.product-list', [
                'products' => $products,
                'category' => null
            ])->render();
        }

        return view('user.home.index', compact('categories', 'products'));
    }

    public function filterByCategori($slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->latest()->get();

        if (request()->ajax()) {
            return view('user.partials.product-list', [
                'products' => $products,
                'category' => $category
            ])->render();
        }

        return view('user.home.index', compact('categories', 'products', 'category'));
    }

    public function detailProduk($id)
    {
        $product = Product::findOrFail($id);
        return view('user.home.detail', compact('product'));
    }
}
