@extends('includePage')
@section('contentTitle', 'Brand List')
@section('contentBody')
    <div class="container mt-4">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h2>Brand List</h2>
            <a href="{{ route('brandCreate') }}" class="btn btn-primary">Add New Brand</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($brands->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
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
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('brandShow', $brand->id) }}" class="btn btn-outline-info btn-sm">View</a>
                                        <a href="{{ route('brandEdit', $brand->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                                        <form action="{{ route('brandDestroy', $brand->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this brand?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                <h5>No brands found.</h5>
                <p>Start by <a href="{{ route('brandCreate') }}">adding a new brand</a>.</p>
            </div>
        @endif
    </div>
@endsection