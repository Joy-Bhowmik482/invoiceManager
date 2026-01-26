@extends('includePage')
@section('contentTitle', 'View Invoice')

@section('contentBody')

<div id="printArea">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Invoice #{{ $invoice->invoice_number }}</h2>
            <div>
                <a href="{{ route('invoiceEdit', $invoice->id) }}" class="btn btn-warning">Edit Invoice</a>
                <a href="{{ route('invoiceList') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Invoice Details</h5>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Client:</strong> {{ $invoice->client->name }}<br>
                        <strong>Email:</strong> {{ $invoice->client->email }}<br>
                        <strong>Phone:</strong> {{ $invoice->client->phone ?? 'N/A' }}
                    </div>
                    <div class="col-md-6 text-end">
                        <strong>Issue Date:</strong> {{ $invoice->issue_date }}<br>
                        <strong>Due Date:</strong> {{ $invoice->due_date }}<br>
                        <strong>Status:</strong>
                        <span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : ($invoice->status == 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($invoice->status) }}
                        </span>
                    </div>
                </div>

                <h6>Items:</h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice->invoiceItems as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ number_format($item->unit_price, 2) }}</td>
                                    <td>${{ number_format($item->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total Amount:</th>
                                <th>${{ number_format($invoice->total_amount, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                {{-- NOTES (ALWAYS VISIBLE) --}}
                <div class="mt-3">
                    <strong>Notes:</strong><br>
                    {{ $invoice->notes ?? '—' }}
                </div>

            </div>
        </div>

        @if($invoice->payments->count() > 0)
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Payment History</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
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
                                        <td>
                                            {{ \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') }}
                                        </td>
                                        <td>${{ number_format($payment->amount, 2) }}</td>
                                        <td>{{ $payment->payment_method ?? 'N/A' }}</td>
                                        <td>{{ $payment->notes ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- PRINT BUTTON --}}
<div class="text-center mt-4">
    <button onclick="printInvoice()" class="btn btn-primary">
        🖨️ Print Invoice
    </button>
</div>

{{-- PRINT SCRIPT --}}
<script>
    function printInvoice() {
        const printContents = document.getElementById('printArea').innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>

@endsection
