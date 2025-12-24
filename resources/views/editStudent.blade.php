@extends('includePage')
@section('contentTitle', 'Edit Student')
@section('contentBody')
    <div class="container mt-4">
        <h2>Edit Student</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-2">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $student->name) }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $student->email) }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $student->phone) }}">
            </div>

            <div class="form-group mb-2">
                <label for="class">Class</label>
                <input type="text" class="form-control" id="class" name="class" value="{{ old('class', $student->class) }}">
            </div>

            <div class="form-group mb-2">
                <label for="roll_number">Roll Number</label>
                <input type="text" class="form-control" id="roll_number" name="roll_number" value="{{ old('roll_number', $student->roll_number) }}">
            </div>

            <div class="form-group mb-3">
                <label for="photo">Photo (optional)</label>
                @if($student->photo)
                    <div class="mb-2">
                        <p class="text-muted">Current Photo:</p>
                        <img src="{{ asset('storage/' . $student->photo) }}" alt="{{ $student->name }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                    </div>
                @endif
                <input type="file" class="form-control" id="photo" name="photo">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Student</button>
                <a href="{{ route('studentList') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
