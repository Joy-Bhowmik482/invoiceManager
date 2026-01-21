@extends('includePage')
@section('contentTitle', 'View Client')
@section('contentBody')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Client Details</h2>
            <div>
                <a href="{{ route('clientEdit', $client->id) }}" class="btn btn-warning me-2">Edit Client</a>
                <a href="{{ route('clientList') }}" class="btn btn-outline-secondary">
                    <i class="ri-arrow-left-line"></i> Back to Client List
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Client Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fw-bold">Full Name:</label>
                            <p class="mb-0">{{ $client->name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fw-bold">Email:</label>
                            <p class="mb-0">{{ $client->email }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fw-bold">Phone:</label>
                            <p class="mb-0">{{ $client->phone ?? 'Not provided' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fw-bold">Created At:</label>
                            <p class="mb-0">{{ $client->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="fw-bold">Address:</label>
                            <p class="mb-0">{{ $client->address ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($client->invoices->count() > 0)
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Invoice History</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Invoice #</th>
                                    <th>Issue Date</th>
                                    <th>Due Date</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($client->invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->issue_date->format('M d, Y') }}</td>
                                        <td>{{ $invoice->due_date->format('M d, Y') }}</td>
                                        <td>${{ number_format($invoice->total_amount, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : ($invoice->status == 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($invoice->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('invoiceShow', $invoice->id) }}" class="btn btn-sm btn-outline-info">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection