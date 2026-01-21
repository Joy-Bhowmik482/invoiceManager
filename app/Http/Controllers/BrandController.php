<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Store a newly created brand.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Brand::create($data);

        return redirect()->route('brandList')->with('success', 'Brand added successfully.');
    }

    /**
     * Display a list of all brands.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('brandList', ['brands' => $brands]);
    }

    /**
     * Display the specified brand.
     */
    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return view('viewBrand', ['brand' => $brand]);
    }

    /**
     * Show the form for editing a brand.
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('editBrand', ['brand' => $brand]);
    }

    /**
     * Update the brand in the database.
     */
    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $brand->update($data);

        return redirect()->route('brandList')->with('success', 'Brand updated successfully.');
    }

    /**
     * Delete a brand from the database.
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('brandList')->with('success', 'Brand deleted successfully.');
    }

    public function create()
    {
        return view('addBrand');
    }
}
