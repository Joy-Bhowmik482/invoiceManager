@extends('includePage')
@section('contentTitle', 'Edit Brand')
@section('contentBody')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Edit Brand</h2>
            <a href="{{ route('brandList') }}" class="btn btn-outline-secondary">
                <i class="ri-arrow-left-line"></i> Back to Brand List
            </a>
        </div>

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

	<form action="{{ route('brandUpdate', $brand->id) }}" method="POST">
		@csrf
		@method('PUT')

		<div class="form-group mb-2">
			<label for="name">Brand Name</label>
			<input type="text" class="form-control" id="name" name="name" value="{{ old('name', $brand->name) }}" required>
		</div>

		<div class="form-group mb-3">
			<label for="description">Description</label>
			<textarea class="form-control" id="description" name="description">{{ old('description', $brand->description) }}</textarea>
		</div>

		<button type="submit" class="btn btn-primary">Update Brand</button>
		<a href="{{ route('brandList') }}" class="btn btn-secondary ms-2">Cancel</a>
	</form>
</div>
@endsection