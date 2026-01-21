<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Product;
use App\Models\InvoiceItem;
use App\Models\Payment;

class InvoiceController extends Controller
{
    /**
     * Display a list of all invoices.
     */
    public function index()
    {
        $invoices = Invoice::with('client')->get();
        return view('invoiceList', ['invoices' => $invoices]);
    }

    /**
     * Show the form for creating a new invoice.
     */
    public function create()
    {
        $clients = Client::all();
        $products = Product::all();
        return view('addInvoice', ['clients' => $clients, 'products' => $products]);
    }

    /**
     * Store a newly created invoice.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after:issue_date',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Generate invoice number
        $data['invoice_number'] = 'INV-' . strtoupper(uniqid());
        $data['total_amount'] = 0;

        $invoice = Invoice::create($data);

        $total = 0;
        foreach ($data['items'] as $item) {
            $product = Product::find($item['product_id']);
            $unitPrice = $product->price;
            $itemTotal = $unitPrice * $item['quantity'];
            $total += $itemTotal;

            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $unitPrice,
                'total' => $itemTotal,
            ]);
        }

        $invoice->update(['total_amount' => $total]);

        return redirect()->route('invoiceList')->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified invoice.
     */
    public function show($id)
    {
        $invoice = Invoice::with('client', 'invoiceItems.product', 'payments')->findOrFail($id);
        return view('viewInvoice', ['invoice' => $invoice]);
    }

    /**
     * Show the form for editing the specified invoice.
     */
    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $clients = Client::all();
        $products = Product::all();
        return view('editInvoice', ['invoice' => $invoice, 'clients' => $clients, 'products' => $products]);
    }

    /**
     * Update the specified invoice in storage.
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after:issue_date',
            'status' => 'required|in:pending,paid,overdue',
            'notes' => 'nullable|string',
        ]);
        $invoice->update($data);
        return redirect()->route('invoiceList')->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified invoice from storage.
     */
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        return redirect()->route('invoiceList')->with('success', 'Invoice deleted successfully.');
    }

    /**
     * Add a payment to an invoice.
     */
    public function addPayment(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $data = $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        Payment::create(array_merge($data, ['invoice_id' => $id]));

        // Update invoice status if fully paid
        $totalPayments = $invoice->payments->sum('amount') + $data['amount'];
        if ($totalPayments >= $invoice->total_amount) {
            $invoice->update(['status' => 'paid']);
        }

        return redirect()->route('invoice.show', $id)->with('success', 'Payment added successfully.');
    }

    /**
     * Mark an invoice as paid.
     */
    public function markAsPaid($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update(['status' => 'paid']);

        return redirect()->route('invoiceList')->with('success', 'Invoice marked as paid successfully.');
    }

    /**
     * Mark an invoice as unpaid (pending).
     */
    public function markAsUnpaid($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update(['status' => 'pending']);

        return redirect()->route('invoiceList')->with('success', 'Invoice marked as unpaid successfully.');
    }
}
