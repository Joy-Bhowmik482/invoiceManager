@extends('includePage')
@section('contentTitle', 'View Invoice')

@section('contentBody')

@php
    use App\Models\Configuration;
    $configuration = Configuration::first();
@endphp

<style>
    .invoice-box {
        background: #fff;
        padding: 30px;
        font-size: 14px;
        color: #333;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .invoice-header {
        border-bottom: 2px solid #007BFF;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }

    .invoice-title {
        font-size: 28px;
        font-weight: bold;
        color: #007BFF;
    }

    .invoice-logo img {
        max-height: 60px;
    }

    .invoice-table th {
        background: #f8f9fa;
        font-weight: bold;
    }

    .summary-table td, .summary-table th {
        padding: 8px 12px;
    }

    .customer-details, .payment-details {
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 12px;
        margin-bottom: 20px;
        background: #f9f9f9;
    }

    .customer-details h6, .payment-details h6 {
        font-weight: bold;
        margin-bottom: 10px;
        color: #007BFF;
    }

    .invoice-footer {
        border-top: 1px solid #ddd;
        margin-top: 30px;
        padding-top: 10px;
        font-size: 12px;
        color: #666;
        text-align: center;
    }

    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>

<div id="printArea">
    <div class="container mt-4">
        <div class="invoice-box">

            {{-- HEADER --}}
            <div class="row invoice-header align-items-center">
                <div class="col-md-6 invoice-logo">
                    @if(file_exists(public_path('logo.png')))
                        <img src="{{ asset('logo.png') }}" alt="Logo">
                    @endif
                    <div style="margin-top:5px;">
                        <strong style="font-size:25px;">
                          {{ optional($configuration)->name ?? 'Company Name' }}
                        </strong>
                        <br>

                        {{ optional($configuration)->address ?? 'Company Address' }}<br>
                        <strong>Phone:</strong> {{ optional($configuration)->phone ?? 'N/A' }}<br>
                        <strong >Email:</strong> {{ optional($configuration)->email ?? 'company@email.com' }}
                    </div>
                </div>

                <div class="col-md-6 text-end">
                    <div class="text-uppercase"><h4 class="text-primary fw-bold">Invoice</h4></div>
                    <strong>Invoice #:</strong> {{ $invoice->invoice_number }}<br>
                    <strong>Invoice Date:</strong> {{ \Carbon\Carbon::parse($invoice->issue_date)->format('M d, Y') }}<br>
                    <strong>Due Date:</strong> {{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}
                </div>
            </div>

            {{-- BILL TO / CUSTOMER CODE / STATUS --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <strong>Bill To:</strong><br>
                    {{ optional($invoice->client)->name ?? 'Client Name' }}<br>
                    {{ optional($invoice->client)->address ?? 'address details' }}<br>
                    {{ optional($invoice->client)->email ?? 'client@email.com' }}<br>
                    {{ optional($invoice->client)->phone ?? 'N/A' }}<br>
                    <strong>Customer ID:</strong> WL-{{ optional($invoice->client)->id ?? 'N/A' }}
                </div>

                <div class="col-md-6 text-end">
                    <strong>Status:</strong>
                    <span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : ($invoice->status == 'pending' ? 'warning' : 'danger') }}">
                        {{ ucfirst($invoice->status) }}
                    </span>
                </div>
            </div>

            {{-- ITEMS TABLE --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th width="80">Qty</th>
                            <th width="120">Unit Price</th>
                            <th width="120">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->invoiceItems as $item)
                        <tr>
                            <td>{{ optional($item->product)->name ?? 'N/A' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->unit_price, 2) }}</td>
                            <td>${{ number_format($item->total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- TOTAL & NOTES --}}
            <div class="row mt-2">
                <div class="col-md-6">
                    <strong>Notes:</strong><br>
                    {{ $invoice->notes ?? '—' }}
                </div>

                <div class="col-md-6">
                    <table class="table table-bordered summary-table">
                        <tr>
                            <th class="text-end">Subtotal:</th>
                            <td class="text-end">${{ number_format($invoice->total_amount, 2) }}</td>
                        </tr>
                        <tr>
                            <th class="text-end">Total Due:</th>
                            <td class="text-end"><strong>${{ number_format($invoice->total_amount, 2) }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- PAYMENT HISTORY --}}
            @if($invoice->payments->count() > 0)
            <div class="mt-4">
                <h6>Payment History</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->payments as $payment)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') }}</td>
                            <td>${{ number_format($payment->amount, 2) }}</td>
                            <td>{{ $payment->payment_method ?? 'N/A' }}</td>
                            <td>{{ $payment->notes ?? '—' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            {{-- CUSTOMER / PAYMENT DETAILS --}}
            <div class="card mt-4 border-0 shadow-sm">
                <div class="card-body payment_details">
                    <div class="card-header ml-0"><h5 class="text-primary fw-bold">Payment History</h5></div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <table class="table table-striped">
                                <tr>
                                    <th>Customer Name:</th>
                                    <td>{{ optional($invoice->client)->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Invoice Date:</th>
                                    <td>{{ \Carbon\Carbon::parse($invoice->issue_date)->format('M d, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Bill Amount:</th>
                                    <td>${{ optional($invoice)->total_amount ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Statement:</th>
                                    <td>{{ $invoice->invoice_number ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Deposit Address:</th>
                                    <td>{{ optional($configuration)->deposit_address ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Deposit Method:</th>
                                    <td>{{ optional($configuration)->deposit_method ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FOOTER --}}
            <div class="invoice-footer">
                Thank you for your business! If you have any questions regarding this invoice, please contact us at <strong>{{ ENV('APP_NAME') ?? 'SS Trade International' }}</strong>.
            </div>

        </div>
    </div>
</div>

{{-- BUTTONS --}}
<div class="text-center mt-4 no-print">
    <a href="{{ route('invoiceEdit', $invoice->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('invoiceList') }}" class="btn btn-secondary">Back</a>
    <button onclick="window.print()" class="btn btn-primary">🖨️ Print</button>
</div>

@endsection
