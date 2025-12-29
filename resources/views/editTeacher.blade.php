@extends('includePage')
@section('contentTitle', 'Edit Teacher')
@section('contentBody')
    <div class="container mt-4">
        <h2>Edit Teacher</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-2">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $teacher->name) }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $teacher->email) }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $teacher->phone) }}">
            </div>

            <div class="form-group mb-2">
                <label for="position">Position</label>
                <input type="text" class="form-control" id="position" name="position" value="{{ old('position', $teacher->position) }}">
            </div>

            <div class="form-group mb-2">
                <label for="department">Department</label>
                <input type="text" class="form-control" id="department" name="department" value="{{ old('department', $teacher->department) }}">
            </div>

            <div class="form-group mb-3">
                <label for="photo">Photo (optional)</label>
                @if($teacher->photo)
                    <div class="mb-2">
                        <p class="text-muted">Current Photo:</p>
                        <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                    </div>
                @endif
                <input type="file" class="form-control" id="photo" name="photo">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Teacher</button>
                <a href="{{ route('teacherList') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
    <div class="mb-4">
    </div>
@endsection
