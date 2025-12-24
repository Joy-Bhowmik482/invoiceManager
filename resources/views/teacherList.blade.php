@extends('includePage')
@section('contentTitle', 'Teacher List')
@section('contentBody')
    <div class="container mt-4">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h2>Teacher List</h2>
            <a href="{{ route('teacherView') }}" class="btn btn-primary">Add New Teacher</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($teachers->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teachers as $teacher)
                            <tr>
                                <td class="text-center">
                                    @if($teacher->photo)
                                        <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="avatar-circle" style="width: 50px; height: 50px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                            {{ substr($teacher->name, 0, 1) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $teacher->name }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->phone ?? 'N/A' }}</td>
                                <td>{{ $teacher->position ?? 'N/A' }}</td>
                                <td>{{ $teacher->department ?? 'N/A' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $teacher->id }}">View</button>
                                        <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                                        <form action="{{ route('teacher.destroy', $teacher->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this teacher?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal{{ $teacher->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $teacher->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel{{ $teacher->id }}">{{ $teacher->name }} Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            @if($teacher->photo)
                                                <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                                            @else
                                                <div class="avatar-circle mx-auto mb-3" style="width: 150px; height: 150px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center; color: white; font-size: 4rem; font-weight: bold;">
                                                    {{ substr($teacher->name, 0, 1) }}
                                                </div>
                                            @endif
                                            <h5 class="mb-3">{{ $teacher->name }}</h5>
                                            <div class="text-start">
                                                <p><strong>Email:</strong> {{ $teacher->email }}</p>
                                                <p><strong>Phone:</strong> {{ $teacher->phone ?? 'N/A' }}</p>
                                                <p><strong>Position:</strong> {{ $teacher->position ?? 'N/A' }}</p>
                                                <p><strong>Department:</strong> {{ $teacher->department ?? 'N/A' }}</p>
                                                <p><strong>Joined:</strong> {{ $teacher->created_at->format('M d, Y') }}</p>
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
                <h5>No teachers found.</h5>
                <p>Start by <a href="{{ route('teacherView') }}">adding a new teacher</a>.</p>
            </div>
        @endif
    </div>
@endsection
