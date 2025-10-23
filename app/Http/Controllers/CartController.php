<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu untuk menambahkan ke keranjang.');
        }

        $request->validate([
            'qty' => 'numeric|min:1'
        ]);

        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += $request->qty;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "qty" => $request->qty,
                "image" => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('message', 'Produk ditambahkan ke keranjang!');
    }

    public function index()
    {
        $cartItems = session()->get('cart', []);
        return view('cart', compact('cartItems'));
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['qty'] = max(1, $request->qty);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index');
    }
}
