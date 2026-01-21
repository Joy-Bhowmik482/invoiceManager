<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($data);

        return redirect()->route('categoryList')->with('success', 'Category added successfully.');
    }

    /**
     * Display a list of all categories.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categoryList', ['categories' => $categories]);
    }

    /**
     * Display the specified category.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('viewCategory', ['category' => $category]);
    }

    /**
     * Show the form for editing a category.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('editCategory', ['category' => $category]);
    }

    /**
     * Update the category in the database.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($data);

        return redirect()->route('categoryList')->with('success', 'Category updated successfully.');
    }

    /**
     * Delete a category from the database.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categoryList')->with('success', 'Category deleted successfully.');
    }

    public function create()
    {
        return view('addCategory');
    }
}
