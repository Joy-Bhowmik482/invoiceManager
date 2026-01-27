@extends('includePage')

@section('contentTitle', 'Add New Configuration')

@section('contentBody')

@if ($configurations->count() > 0)
    @php
    $name = $configurations->first()->name;
    $email = $configurations->first()->email;
    $phone = $configurations->first()->phone;
    $address = $configurations->first()->address;
    $deposit_address = $configurations->first()->deposit_address;
    $deposit_method = $configurations->first()->deposit_method;
    @endphp
@else
    @php
    $name = '';
    $email = '';
    $phone = '';
    $address = '';
    $deposit_address = '';
    $deposit_method = '';
    @endphp
@endif

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

                        @if($configurations->count() > 0)
                            <input type="hidden" name="id" value="{{ $configurations->first()->id }}">
                        @endif

                        <!-- Configuration Name -->
                        <div class="mb-3 form-floating">
                            <input type="text"
                                   class="form-control form-control-lg border-0 shadow-sm"
                                   id="name"
                                   name="name"
                                   placeholder="Configuration Name"
                                   value="{{ $name }}"
                                   required>
                            <label for="name">
                                <i class="ri-settings-line me-1"></i>Configuration Name
                            </label>
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3 form-floating">
                            <input type="email"
                                   class="form-control form-control-lg border-0 shadow-sm"
                                   id="email"
                                   name="email"
                                   placeholder="Email Address"
                                   value="{{ $email }}"
                                   required>
                            <label for="email">
                                <i class="ri-mail-line me-1"></i>Email Address
                            </label>
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-3 form-floating">
                            <input type="tel"
                                   class="form-control form-control-lg border-0 shadow-sm"
                                   id="phone"
                                   name="phone"
                                   placeholder="Phone Number"
                                   value="{{ $phone }}"
                                   required>
                            <label for="phone">
                                <i class="ri-phone-line me-1"></i>Phone Number
                            </label>
                        </div>

                        <!-- Address -->
                        <div class="mb-3 form-floating">
                            <input type="text"
                                   class="form-control form-control-lg border-0 shadow-sm"
                                   id="address"
                                   name="address"
                                   placeholder="Address"
                                   value="{{ $address }}"
                                   required>
                            <label for="address">
                                <i class="ri-map-pin-line me-1"></i>Address
                            </label>
                        </div>

                        <!-- Deposit Address (NEW) -->
                        <div class="mb-4 form-floating">
                            <input type="text"
                                   class="form-control form-control-lg border-0 shadow-sm"
                                   id="deposit_address"
                                   name="deposit_address"
                                   placeholder="Deposit Address"
                                   value="{{ $deposit_address }}"
                                   required>
                            <label for="deposit_address">
                                <i class="ri-bank-line me-1"></i>Deposit Address
                            </label>
                        </div>

                        <!-- Deposit Method (NEW) -->
                        <div class="mb-4 form-floating">
                            <input type="text"
                                   class="form-control form-control-lg border-0 shadow-sm"
                                   id="deposit_method"
                                   name="deposit_method"
                                   placeholder="Deposit Method"
                                   value="{{ $deposit_method }}"
                                   required>
                            <label for="deposit_method">
                                <i class="ri-money-dollar-circle-line me-1"></i>Deposit Method
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning btn-lg rounded-pill shadow fw-bold">
                                <i class="ri-add-circle-line me-2"></i>Save Configuration
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
