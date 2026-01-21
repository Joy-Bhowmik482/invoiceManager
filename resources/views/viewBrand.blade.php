@extends('includePage')
@section('contentTitle', 'View Brand')
@section('contentBody')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Brand Details</h2>
            <div>
                <a href="{{ route('brandEdit', $brand->id) }}" class="btn btn-warning me-2">Edit Brand</a>
                <a href="{{ route('brandList') }}" class="btn btn-outline-secondary">
                    <i class="ri-arrow-left-line"></i> Back to Brand List
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Brand Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fw-bold">Brand Name:</label>
                            <p class="mb-0">{{ $brand->name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fw-bold">Created At:</label>
                            <p class="mb-0">{{ $brand->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="fw-bold">Description:</label>
                            <p class="mb-0">{{ $brand->description ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection