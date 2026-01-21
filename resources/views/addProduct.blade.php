@extends('includePage')
@section('contentTitle', 'Add New Product')
@section('contentBody')
    <div class="container mt-4">
        <div class="d-flex justify-content-center">
            <div class="w-100" style="max-width: 600px;">
                <h2 class="text-center mb-4">Add New Product</h2>

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

                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-success text-white border-0 rounded-top-4">
                        <div class="d-flex align-items-center">
                            <i class="ri-archive-line me-2"></i>
                            <h5 class="card-title mb-0 fw-bold" style="color: white !important;">Product Information</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('productStore') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-control-lg border-0 shadow" id="name" name="name" placeholder="Product Name" value="{{ old('name') }}" required>
                                    <label for="name" class="text-muted"><i class="ri-price-tag-line me-1"></i>Product Name</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control form-control-lg border-0 shadow" id="description" name="description" placeholder="Product Description" style="height: 100px;">{{ old('description') }}</textarea>
                                    <label for="description" class="text-muted"><i class="ri-file-text-line me-1"></i>Product Description</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control form-control-lg border-0 shadow" id="price" name="price" placeholder="Price" value="{{ old('price') }}" required>
                                    <label for="price" class="text-muted"><i class="ri-money-dollar-circle-line me-1"></i>Price</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <select class="form-select form-select-lg border-0 shadow" id="brand_id" name="brand_id" style="height: 58px; font-weight: 500;">
                                        <option value="" selected disabled hidden style="color: #6c757d; font-style: italic;">Select Brand (Optional)</option>
                                        <option value="" style="color: #6c757d;">None</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }} style="color: #212529;">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="brand_id" class="text-muted"><i class="ri-price-tag-3-line me-1"></i>Brand</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-floating">
                                    <select class="form-select form-select-lg border-0 shadow" id="category_id" name="category_id" style="height: 58px; font-weight: 500;">
                                        <option value="" selected disabled hidden style="color: #6c757d; font-style: italic;">Select Category (Optional)</option>
                                        <option value="" style="color: #6c757d;">None</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }} style="color: #212529;">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="category_id" class="text-muted"><i class="ri-folder-line me-1"></i>Category</label>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg rounded-pill shadow fw-bold">
                                    <i class="ri-add-circle-line me-2"></i>Add Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection