@extends('includePage')
@section('contentTitle', 'Staff List')
@section('contentBody')
    <div class="container mt-4">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h2>Staff List</h2>
            <a href="{{ route('staffView') }}" class="btn btn-primary">Add New Staff</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($staffMembers->count() > 0)
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
                        @foreach($staffMembers as $staff)
                            <tr>
                                <td class="text-center">
                                    @if($staff->photo)
                                        <img src="{{ asset('storage/' . $staff->photo) }}" alt="{{ $staff->name }}" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="avatar-circle" style="width: 50px; height: 50px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                            {{ substr($staff->name, 0, 1) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $staff->name }}</td>
                                <td>{{ $staff->email }}</td>
                                <td>{{ $staff->phone ?? 'N/A' }}</td>
                                <td>{{ $staff->position ?? 'N/A' }}</td>
                                <td>{{ $staff->department ?? 'N/A' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $staff->id }}">View</button>
                                        <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                                        <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this staff member?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal{{ $staff->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $staff->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel{{ $staff->id }}">{{ $staff->name }} Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            @if($staff->photo)
                                                <img src="{{ asset('storage/' . $staff->photo) }}" alt="{{ $staff->name }}" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                                            @else
                                                <div class="avatar-circle mx-auto mb-3" style="width: 150px; height: 150px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center; color: white; font-size: 4rem; font-weight: bold;">
                                                    {{ substr($staff->name, 0, 1) }}
                                                </div>
                                            @endif
                                            <h5 class="mb-3">{{ $staff->name }}</h5>
                                            <div class="text-start">
                                                <p><strong>Email:</strong> {{ $staff->email }}</p>
                                                <p><strong>Phone:</strong> {{ $staff->phone ?? 'N/A' }}</p>
                                                <p><strong>Position:</strong> {{ $staff->position ?? 'N/A' }}</p>
                                                <p><strong>Department:</strong> {{ $staff->department ?? 'N/A' }}</p>
                                                <p><strong>Joined:</strong> {{ $staff->created_at->format('M d, Y') }}</p>
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
                <h5>No staff members found.</h5>
                <p>Start by <a href="{{ route('addNew') }}">adding a new staff member</a>.</p>
            </div>
        @endif
    </div>
@endsection
