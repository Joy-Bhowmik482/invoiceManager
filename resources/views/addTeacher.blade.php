@extends('includePage')
@section('contentTitle', 'Add New Teacher')
@section('contentBody')
    <div class="container mt-4">
    <h2>Add New Teacher</h2>

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

    <form action="{{ url('/teacher') }}" method="POST" enctype="multipart/form-data">
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
            <label for="position">Position</label>
            <input type="text" class="form-control" id="position" name="position" value="{{ old('position') }}">
        </div>

        <div class="form-group mb-2">
            <label for="department">Department</label>
            <input type="text" class="form-control" id="department" name="department" value="{{ old('department') }}">
        </div>

        <div class="form-group mb-3">
            <label for="photo">Photo (optional)</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>

        <button type="submit" class="btn btn-primary">Add Teacher</button>
    </form>
</div>
@endsection


