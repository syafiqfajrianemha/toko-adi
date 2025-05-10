<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'description'   => 'required',
            'price'         => 'required|numeric',
            'image'         => 'required|mimes:png,jpg,jpeg',
            'category_id'   => 'required|numeric'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('products', $image, $imageName);
            }
        }

        Product::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'price'         => $request->price,
            'image'         => $imageName,
            'category_id'   => $request->category_id
        ]);

        return redirect()->route('admin.product.index')->with('message', 'Product has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::latest()->get();
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required',
            'description'   => 'required',
            'price'         => 'required|numeric',
            'image'         => 'nullable|mimes:png,jpg,jpeg',
            'category_id'   => 'required|numeric'
        ]);

        $product = Product::findOrFail($id);

        $imageName = $product->image;

        if ($request->hasFile('image')) {
            if ($product->image) {
                File::delete('storage/products/' . $product->image);
            }

            $image = $request->file('image');

            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('products', $image, $imageName);
            }
        }

        $product->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'price'         => $request->price,
            'image'         => $imageName,
            'category_id'   => $request->category_id
        ]);

        return redirect()->route('admin.product.index')->with('message', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        File::delete('storage/products/' . $product->image);
        $product->delete();
        return redirect()->route('admin.product.index')->with('message', 'Product has been deleted');
    }
}
