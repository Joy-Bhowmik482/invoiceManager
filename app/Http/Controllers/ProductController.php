<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'brand_id' => 'nullable|exists:brands,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Product::create($data);

        return redirect()->route('productList')->with('success', 'Product added successfully.');
    }

    public function index()
    {
        $products = Product::with('brand', 'category')->get();
        return view('productList', ['products' => $products]);
    }

    public function show($id)
    {
        $product = Product::with('brand', 'category')->findOrFail($id);
        return view('viewProduct', ['product' => $product]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::all();
        $categories = Category::all();
        return view('editProduct', compact('product', 'brands', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'brand_id' => 'nullable|exists:brands,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $product->update($data);

        return redirect()->route('productList')->with('success', 'Product updated successfully.');
    }

    /**
     * Delete a product from the database.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('productList')->with('success', 'Product deleted successfully.');
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('addProduct', compact('brands', 'categories'));
    }
}
