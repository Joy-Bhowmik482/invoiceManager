@extends('includePage')
@section('contentTitle', 'Add New Category')
@section('contentBody')
    <div class="container mt-4">
        <div class="d-flex justify-content-center">
            <div class="w-100" style="max-width: 600px;">
                <h2 class="text-center mb-4">Add New Category</h2>

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
                    <div class="card-header bg-primary text-white border-0 rounded-top-4">
                        <div class="d-flex align-items-center">
                            <i class="ri-add-circle-line me-2"></i>
                            <h5 class="card-title mb-0 fw-bold" style="color: white !important;">Category Information</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('categoryStore') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-control-lg border-0 shadow" id="name" name="name" placeholder="Category Name" value="{{ old('name') }}" required>
                                    <label for="name" class="text-muted"><i class="ri-folder-line me-1"></i>Category Name</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-floating">
                                    <textarea class="form-control form-control-lg border-0 shadow" id="description" name="description" placeholder="Description" style="height: 80px;">{{ old('description') }}</textarea>
                                    <label for="description" class="text-muted"><i class="ri-file-text-line me-1"></i>Description</label>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow fw-bold">
                                    <i class="ri-add-circle-line me-2"></i>Add Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection