<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\Brand;
use App\Models\Category;

class SearchController extends Controller
{
    /**
     * Handle search requests across all entities.
     */
    public function search(Request $request)
    {
        $query = $request->get('query');

        if (!$query) {
            return redirect()->route('dashboard');
        }

        // Search clients
        $clients = Client::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('email', 'LIKE', "%{$query}%")
                        ->orWhere('phone', 'LIKE', "%{$query}%")
                        ->get();

        // Search products
        $products = Product::where('name', 'LIKE', "%{$query}%")
                          ->orWhere('description', 'LIKE', "%{$query}%")
                          ->get();

        // Search brands
        $brands = Brand::where('name', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%")
                      ->get();

        // Search categories
        $categories = Category::where('name', 'LIKE', "%{$query}%")
                             ->orWhere('description', 'LIKE', "%{$query}%")
                             ->get();

        // Search invoices
        $invoices = Invoice::where('invoice_number', 'LIKE', "%{$query}%")
                          ->orWhere('notes', 'LIKE', "%{$query}%")
                          ->with('client')
                          ->get();

        return view('searchResults', compact('query', 'clients', 'products', 'brands', 'categories', 'invoices'));
    }
}