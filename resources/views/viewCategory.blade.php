@extends('includePage')
@section('contentTitle', 'View Category')
@section('contentBody')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Category Details</h2>
            <div>
                <a href="{{ route('categoryEdit', $category->id) }}" class="btn btn-warning me-2">Edit Category</a>
                <a href="{{ route('categoryList') }}" class="btn btn-outline-secondary">
                    <i class="ri-arrow-left-line"></i> Back to Category List
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Category Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fw-bold">Category Name:</label>
                            <p class="mb-0">{{ $category->name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="fw-bold">Created At:</label>
                            <p class="mb-0">{{ $category->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="fw-bold">Description:</label>
                            <p class="mb-0">{{ $category->description ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection