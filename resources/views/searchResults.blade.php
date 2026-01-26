@extends('includePage')
@section('contentTitle', 'Search Results')
@section('contentBody')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Search Results for "{{ $query }}"</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                <i class="ri-arrow-left-line"></i> Back to Dashboard
            </a>
        </div>

        @if($clients->count() > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Clients ({{ $clients->count() }} results)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td class="fw-semibold">{{ $client->name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->phone ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('clientShow', $client->id) }}" class="btn btn-sm btn-outline-info">View</a>
                                            <a href="{{ route('clientEdit', $client->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                            <form action="{{ route('clientDestroy', $client->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this client?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        @if($products->count() > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Products ({{ $products->count() }} results)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="fw-semibold">{{ $product->name }}</td>
                                        <td>{{ $product->description ?? 'N/A' }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>
                                            <a href="{{ route('productShow', $product->id) }}" class="btn btn-sm btn-outline-info">View</a>
                                            <a href="{{ route('productEdit', $product->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                            <form action="{{ route('productDestroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        @if($brands->count() > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Brands ({{ $brands->count() }} results)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brands as $brand)
                                    <tr>
                                        <td class="fw-semibold">{{ $brand->name }}</td>
                                        <td>{{ $brand->description ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('brandShow', $brand->id) }}" class="btn btn-sm btn-outline-info">View</a>
                                            <a href="{{ route('brandEdit', $brand->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                            <form action="{{ route('brandDestroy', $brand->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this brand?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        @if($categories->count() > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Categories ({{ $categories->count() }} results)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td class="fw-semibold">{{ $category->name }}</td>
                                        <td>{{ $category->description ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('categoryShow', $category->id) }}" class="btn btn-sm btn-outline-info">View</a>
                                            <a href="{{ route('categoryEdit', $category->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                            <form action="{{ route('categoryDestroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        @if($invoices->count() > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Invoices ({{ $invoices->count() }} results)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Invoice #</th>
                                    <th>Client</th>
                                    <th>Issue Date</th>
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
                                        <td>{{ $invoice->issue_date->format('M d, Y') }}</td>
                                        <td>${{ number_format($invoice->total_amount, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : ($invoice->status == 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($invoice->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('invoiceShow', $invoice->id) }}" class="btn btn-sm btn-outline-info">View</a>
                                            <a href="{{ route('invoiceEdit', $invoice->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        @if($clients->count() == 0 && $products->count() == 0 && $brands->count() == 0 && $categories->count() == 0 && $invoices->count() == 0)
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="ri-search-line fs-1 text-muted"></i>
                    </div>
                    <h5>No results found</h5>
                    <p class="text-muted">Try searching with different keywords or check your spelling.</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
                </div>
            </div>
        @endif
    </div>
@endsection