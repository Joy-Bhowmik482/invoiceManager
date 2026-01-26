@extends('includePage')
@section('contentTitle', 'View Product')
@section('contentBody')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Product Details</h2>
            <div>
                <a href="{{ route('productEdit', $product->id) }}" class="btn btn-warning me-2">Edit Product</a>
                <a href="{{ route('productList') }}" class="btn btn-outline-secondary">
                    <i class="ri-arrow-left-line"></i> Back to Product List
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Product Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fw-bold">Product Name:</label>
                            <p class="mb-0">{{ $product->name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fw-bold">Price:</label>
                            <p class="mb-0">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fw-bold">Created At:</label>
                            <p class="mb-0">{{ $product->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="fw-bold">Description:</label>
                            <p class="mb-0">{{ $product->description ?? 'No description available' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection