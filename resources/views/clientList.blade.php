@extends('includePage')
@section('contentTitle', 'Client List')
@section('contentBody')
    <div class="container mt-4">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h2>Client List</h2>
            <a href="{{ route('clientCreate') }}" class="btn btn-primary">Add New Client</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($clients->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td class="fw-semibold">{{ $client->name }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->phone ?? 'N/A' }}</td>
                                <td>{{ $client->address ?? 'N/A' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('clientShow', $client->id) }}" class="btn btn-outline-info btn-sm">View</a>
                                        <a href="{{ route('clientEdit', $client->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                                        <form action="{{ route('clientDestroy', $client->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this client?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                <h5>No clients found.</h5>
                <p>Start by <a href="{{ route('clientCreate') }}">adding a new client</a>.</p>
            </div>
        @endif
    </div>
@endsection