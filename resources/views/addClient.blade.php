@extends('includePage')
@section('contentTitle', 'Add New Client')
@section('contentBody')
    <div class="container mt-4">
        <div class="d-flex justify-content-center">
            <div class="w-100" style="max-width: 600px;">
                <h2 class="text-center mb-4">Add New Client</h2>

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

                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white border-0 rounded-top-4">
                        <div class="d-flex align-items-center">
                            <i class="ri-user-add-line me-2"></i>
                            <h5 class="card-title mb-0 fw-bold" style="color: white !important;">Client Information</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('clientStore') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-control-lg border-0 shadow" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                                    <label for="name" class="text-muted"><i class="ri-user-line me-1"></i>Full Name</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="email" class="form-control form-control-lg border-0 shadow" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                                    <label for="email" class="text-muted"><i class="ri-mail-line me-1"></i>Email Address</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-control-lg border-0 shadow" id="phone" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                                    <label for="phone" class="text-muted"><i class="ri-phone-line me-1"></i>Phone Number</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-floating">
                                    <textarea class="form-control form-control-lg border-0 shadow" id="address" name="address" placeholder="Address" style="height: 80px;">{{ old('address') }}</textarea>
                                    <label for="address" class="text-muted"><i class="ri-map-pin-line me-1"></i>Address</label>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow fw-bold">
                                    <i class="ri-add-circle-line me-2"></i>Add Client
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection