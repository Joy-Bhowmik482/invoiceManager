<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Product;
use App\Models\Invoice;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClients = Client::count();
        $totalProducts = Product::count();
        $totalInvoices = Invoice::count();
        $totalPaidInvoices = Invoice::where('status', 'paid')->count();
        $totalPendingInvoices = Invoice::where('status', 'pending')->count();
        $totalOverdueInvoices = Invoice::where('status', 'overdue')->count();
        $totalRevenue = Invoice::where('status', 'paid')->sum('total_amount');

        return view('homePage', compact(
            'totalClients',
            'totalProducts',
            'totalInvoices',
            'totalPaidInvoices',
            'totalPendingInvoices',
            'totalOverdueInvoices',
            'totalRevenue'
        ));
    }
}
