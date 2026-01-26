
@extends('includePage')

@section('contentTitle', 'Add New Product')

@section('contentBody')

<style>
    /* ===== Professional Select Override ===== */
    .form-select {
        background-color: #f9fafb !important;
        border: 1px solid #d1d5db !important;
        border-radius: 14px !important;
        color: #374151 !important;
        font-weight: 500;
        box-shadow: 0 6px 14px rgba(0,0,0,0.06) !important;
        transition: all 0.2s ease-in-out;
    }

    .form-select:hover {
        background-color: #f3f4f6 !important;
        border-color: #9ca3af !important;
    }

    .form-select:focus {
        outline: none !important;
        border-color: #9ca3af !important;
        box-shadow: 0 0 0 2px rgba(0,0,0,0.08) !important;
    }

    .form-select option {
        background-color: #ffffff;
        color: #111827;
        padding: 10px;
    }

    .form-select option:hover,
    .form-select option:checked {
        background-color: #e5e7eb !important;
        color: #111827 !important;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-center">
        <div class="w-100" style="max-width: 600px;">

            <h2 class="text-center mb-4">Add New Product</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-success text-white rounded-top-4">
                    <h5 class="mb-0 fw-bold">
                        <i class="ri-archive-line me-2"></i>Product Information
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('productStore') }}" method="POST">
                        @csrf

                        <!-- Product Name -->
                        <div class="mb-3 form-floating">
                            <input type="text"
                                   class="form-control form-control-lg border-0 shadow-sm"
                                   id="name"
                                   name="name"
                                   placeholder="Product Name"
                                   value="{{ old('name') }}"
                                   required>
                            <label for="name">Product Name</label>
                        </div>

                        <!-- Description -->
                        <div class="mb-3 form-floating">
                            <textarea class="form-control form-control-lg border-0 shadow-sm"
                                      id="description"
                                      name="description"
                                      placeholder="Description"
                                      style="height: 100px;">{{ old('description') }}</textarea>
                            <label for="description">Product Description</label>
                        </div>

                        <!-- Price -->
                        <div class="mb-3 form-floating">
                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   class="form-control form-control-lg border-0 shadow-sm"
                                   id="price"
                                   name="price"
                                   placeholder="Price"
                                   value="{{ old('price') }}"
                                   required>
                            <label for="price">Price</label>
                        </div>

                        <!-- Brand -->
                        <div class="mb-3 form-floating">
                            <select class="form-select form-select-lg"
                                    id="brand_id"
                                    name="brand_id">
                                <option value="" disabled {{ old('brand_id') ? '' : 'selected' }}>
                                    Select Brand (Optional)
                                </option>
                                <option value="">None</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">
                                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="brand_id">Brand</label>
                        </div>

                        <!-- Category -->
                        <div class="mb-4 form-floating">
                            <select class="form-select form-select-lg"
                                    id="category_id"
                                    name="category_id">
                                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>
                                    Select Category (Optional)
                                </option>
                                <option value="">None</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="category_id">Category</label>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit"
                                    class="btn btn-success btn-lg rounded-pill fw-bold shadow">
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
