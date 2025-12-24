@extends('includePage')
@section('contentTitle', 'Student List')
@section('contentBody')
    <div class="container mt-4">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h2>Student List</h2>
            <a href="{{ route('studentView') }}" class="btn btn-primary">Add New Student</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($studentMembers->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Class</th>
                            <th>Roll Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studentMembers as $student)
                            <tr>
                                <td class="text-center">
                                    @if($student->photo)
                                        <img src="{{ asset('storage/' . $student->photo) }}" alt="{{ $student->name }}" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="avatar-circle" style="width: 50px; height: 50px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                            {{ substr($student->name, 0, 1) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->phone ?? 'N/A' }}</td>
                                <td>{{ $student->class ?? 'N/A' }}</td>
                                <td>{{ $student->roll_number ?? 'N/A' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $student->id }}">View</button>
                                        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                                        <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal{{ $student->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $student->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel{{ $student->id }}">{{ $student->name }} Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            @if($student->photo)
                                                <img src="{{ asset('storage/' . $student->photo) }}" alt="{{ $student->name }}" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                                            @else
                                                <div class="avatar-circle mx-auto mb-3" style="width: 150px; height: 150px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center; color: white; font-size: 4rem; font-weight: bold;">
                                                    {{ substr($student->name, 0, 1) }}
                                                </div>
                                            @endif
                                            <h5 class="mb-3">{{ $student->name }}</h5>
                                            <div class="text-start">
                                                <p><strong>Email:</strong> {{ $student->email }}</p>
                                                <p><strong>Phone:</strong> {{ $student->phone ?? 'N/A' }}</p>
                                                <p><strong>Class:</strong> {{ $student->class ?? 'N/A' }}</p>
                                                <p><strong>Roll Number:</strong> {{ $student->roll_number ?? 'N/A' }}</p>
                                                <p><strong>Joined:</strong> {{ optional($student->created_at)->format('M d, Y') ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                <h5>No students found.</h5>
                <p>Start by <a href="{{ route('studentView') }}">adding a new student</a>.</p>
            </div>
        @endif
    </div>
@endsection
