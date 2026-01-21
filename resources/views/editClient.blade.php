@extends('includePage')
@section('contentTitle', 'Edit Client')
@section('contentBody')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Edit Client</h2>
            <a href="{{ route('clientList') }}" class="btn btn-outline-secondary">
                <i class="ri-arrow-left-line"></i> Back to Client List
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

	<form action="{{ route('clientUpdate', $client->id) }}" method="POST">
		@csrf
		@method('PUT')

		<div class="form-group mb-2">
			<label for="name">Full Name</label>
			<input type="text" class="form-control" id="name" name="name" value="{{ old('name', $client->name) }}" required>
		</div>

		<div class="form-group mb-2">
			<label for="email">Email</label>
			<input type="email" class="form-control" id="email" name="email" value="{{ old('email', $client->email) }}" required>
		</div>

		<div class="form-group mb-2">
			<label for="phone">Phone</label>
			<input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $client->phone) }}">
		</div>

		<div class="form-group mb-3">
			<label for="address">Address</label>
			<textarea class="form-control" id="address" name="address">{{ old('address', $client->address) }}</textarea>
		</div>

		<button type="submit" class="btn btn-primary">Update Client</button>
		<a href="{{ route('clientList') }}" class="btn btn-secondary ms-2">Cancel</a>
	</form>
</div>
@endsection