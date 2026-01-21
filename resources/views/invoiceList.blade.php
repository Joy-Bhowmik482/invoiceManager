@extends('includePage')
@section('contentTitle', 'Invoice List')
@section('contentBody')
    <div class="container mt-4">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h2>Invoice List</h2>
            <a href="{{ route('invoiceCreate') }}" class="btn btn-primary">Create New Invoice</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($invoices->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Invoice #</th>
                            <th>Client</th>
                            <th>Issue Date</th>
                            <th>Due Date</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td class="fw-semibold">{{ $invoice->invoice_number }}</td>
                                <td>{{ $invoice->client->name }}</td>
                                <td>{{ $invoice->issue_date }}</td>
                                <td>{{ $invoice->due_date }}</td>
                                <td>${{ number_format($invoice->total_amount, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : ($invoice->status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($invoice->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm me-2" role="group">
                                        <a href="{{ route('invoiceShow', $invoice->id) }}" class="btn btn-outline-info btn-sm">View</a>
                                        <a href="{{ route('invoiceEdit', $invoice->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                                        <form action="{{ route('invoiceDestroy', $invoice->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                    @if($invoice->status === 'paid')
                                        <form action="{{ route('invoiceMarkUnpaid', $invoice->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-outline-warning btn-sm" style="min-width: 70px;" onclick="return confirm('Are you sure you want to mark this invoice as unpaid?');">Unpaid</button>
                                        </form>
                                    @else
                                        <form action="{{ route('invoiceMarkPaid', $invoice->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-outline-success btn-sm" style="min-width: 70px;" onclick="return confirm('Are you sure you want to mark this invoice as paid?');">Paid</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                <h5>No invoices found.</h5>
                <p>Start by <a href="{{ route('invoiceCreate') }}">creating a new invoice</a>.</p>
            </div>
        @endif
    </div>
@endsection