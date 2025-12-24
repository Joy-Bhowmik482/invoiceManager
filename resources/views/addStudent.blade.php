@extends('includePage')
@section('contentTitle', 'Add New Student')
@section('contentBody')
    <div class="container mt-4">
	<h2>Add New Student</h2>

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

	<form action="{{ url('/student') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="form-group mb-2">
			<label for="name">Full Name</label>
			<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
		</div>

		<div class="form-group mb-2">
			<label for="email">Email</label>
			<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
		</div>

		<div class="form-group mb-2">
			<label for="phone">Phone</label>
			<input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
		</div>

		<div class="form-group mb-2">
			<label for="class">Class</label>
			<input type="text" class="form-control" id="class" name="class" value="{{ old('class') }}">
		</div>

		<div class="form-group mb-2">
			<label for="roll_number">Roll Number</label>
			<input type="text" class="form-control" id="roll_number" name="roll_number" value="{{ old('roll_number') }}">
		</div>

		<div class="form-group mb-3">
			<label for="photo">Photo (optional)</label>
			<input type="file" class="form-control" id="photo" name="photo">
		</div>

		<button type="submit" class="btn btn-primary">Add Student</button>
	</form>
</div>
@endsection