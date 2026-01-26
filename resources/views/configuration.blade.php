@extends('includePage')

@section('contentTitle', 'Add New Configuration')

@section('contentBody')

<div class="container mt-4">
    <div class="d-flex justify-content-center">
        <div class="w-100" style="max-width: 600px;">

            <h2 class="text-center mb-4">Add New Configuration</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-warning text-white rounded-top-4">
                    <h5 class="mb-0 fw-bold">
                        <i class="ri-settings-3-line me-2"></i>Configuration Information
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('configuration.configstore') }}" method="POST">
                        @csrf

                        <!-- Configuration Name -->
                        <div class="mb-3 form-floating">
                            <input type="text"
                                   class="form-control form-control-lg border-0 shadow-sm"
                                   id="name"
                                   name="name"
                                   placeholder="Configuration Name"
                                   value="{{ old('name') }}"
                                   required>
                            <label for="name"><i class="ri-settings-line me-1"></i>Configuration Name</label>
                        </div>

                        <!-- Configuration Key -->
                        <div class="mb-3 form-floating">
                            <input type="text"
                                   class="form-control form-control-lg border-0 shadow-sm"
                                   id="key"
                                   name="key"
                                   placeholder="Configuration Key"
                                   value="{{ old('key') }}"
                                   required>
                            <label for="key"><i class="ri-key-line me-1"></i>Configuration Key</label>
                        </div>

                        <!-- Configuration Value -->
                        <div class="mb-4 form-floating">
                            <textarea class="form-control form-control-lg border-0 shadow-sm"
                                      id="value"
                                      name="value"
                                      placeholder="Configuration Value"
                                      style="height: 80px;">{{ old('value') }}</textarea>
                            <label for="value"><i class="ri-file-text-line me-1"></i>Configuration Value</label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning btn-lg rounded-pill shadow fw-bold">
                                <i class="ri-add-circle-line me-2"></i>Add Configuration
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
