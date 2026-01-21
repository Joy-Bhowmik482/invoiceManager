@extends('includePage')
@section('contentTitle', 'Edit Product')
@section('contentBody')
    <div class="container mt-4">
	<h2>Edit Product</h2>

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

	<form action="{{ route('productUpdate', $product->id) }}" method="POST">
		@csrf
		@method('PUT')

		<div class="form-group mb-2">
			<label for="name">Product Name</label>
			<input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
		</div>

		<div class="form-group mb-2">
			<label for="description">Description</label>
			<textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
		</div>

		<div class="form-group mb-2">
			<label for="price">Price</label>
			<input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
		</div>

		<div class="form-group mb-2">
			<label for="stock_quantity">Stock Quantity</label>
			<input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
		</div>

		<div class="form-group mb-2">
			<label for="brand_id">Brand</label>
			<select class="form-control" id="brand_id" name="brand_id">
				<option value="">Select Brand (Optional)</option>
				@foreach($brands as $brand)
					<option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group mb-3">
			<label for="category_id">Category</label>
			<select class="form-control" id="category_id" name="category_id">
				<option value="">Select Category (Optional)</option>
				@foreach($categories as $category)
					<option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
				@endforeach
			</select>
		</div>

		<button type="submit" class="btn btn-primary">Update Product</button>
		<a href="{{ route('productList') }}" class="btn btn-secondary">Cancel</a>
	</form>
</div>
@endsection