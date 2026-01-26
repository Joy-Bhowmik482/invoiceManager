@extends('includePage')
@section('contentTitle', 'Edit Invoice')
@section('contentBody')
<div class="container mt-4">
    <h2>Edit Invoice #{{ $invoice->invoice_number }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="alert alert-info">
        <strong>Note:</strong> Currently, only basic invoice information can be edited. For item changes, please create a new invoice.
    </div>

    <form action="{{ route('invoiceUpdate', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="client_id">Client</label>
                    <select class="form-control" id="client_id" name="client_id" required>
                        <option value="">Select Client</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ $invoice->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label for="issue_date">Issue Date</label>
                    <input type="date" class="form-control" id="issue_date" name="issue_date" 
                        value="{{ \Carbon\Carbon::parse($invoice->issue_date)->format('Y-m-d') }}" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label for="due_date">Due Date</label>
                    <input type="date" class="form-control" id="due_date" name="due_date" 
                        value="{{ \Carbon\Carbon::parse($invoice->due_date)->format('Y-m-d') }}" required>
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pending" {{ $invoice->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="overdue" {{ $invoice->status == 'overdue' ? 'selected' : '' }}>Overdue</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" name="notes">{{ $invoice->notes }}</textarea>
        </div>

        <h4>Current Items</h4>
        <div class="table-responsive mb-3">
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

        <button type="submit" class="btn btn-primary">Update Invoice</button>
        <a href="{{ route('invoiceList') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
