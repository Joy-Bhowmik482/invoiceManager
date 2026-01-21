@extends('includePage')
@section('contentTitle','Invoice Manager - Professional Invoice Management System')
@section('contentBody')
    <div class="container-fluid" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh; padding: 2rem 0;">
        <!-- Header Section -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="display-5 fw-bold text-primary mb-3" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">Invoice Manager</h1>
                <p class="lead text-muted">Professional Invoice Management System</p>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="row g-3 mb-4">
            <!-- Total Clients -->
            <div class="col-xl-3 col-md-6">
                <div class="card h-100 border-0 shadow" style="border-radius: 10px; transition: transform 0.2s ease;" onmouseover="this.style.transform='translateY(-5px)';" onmouseout="this.style.transform='translateY(0)';">
                    <div class="card-body text-center p-3">
                        <div class="avatar-md mx-auto mb-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="ri-user-line fs-4 text-white"></i>
                        </div>
                        <h4 class="fw-bold text-primary mb-1">{{ $totalClients }}</h4>
                        <p class="text-muted mb-0 small">Total Clients</p>
                    </div>
                </div>
            </div>

            <!-- Total Products -->
            <div class="col-xl-3 col-md-6">
                <div class="card h-100 border-0 shadow" style="border-radius: 10px; transition: transform 0.2s ease;" onmouseover="this.style.transform='translateY(-5px)';" onmouseout="this.style.transform='translateY(0)';">
                    <div class="card-body text-center p-3">
                        <div class="avatar-md mx-auto mb-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="ri-shopping-bag-line fs-4 text-white"></i>
                        </div>
                        <h4 class="fw-bold text-success mb-1">{{ $totalProducts }}</h4>
                        <p class="text-muted mb-0 small">Total Products</p>
                    </div>
                </div>
            </div>

            <!-- Total Invoices -->
            <div class="col-xl-3 col-md-6">
                <div class="card h-100 border-0 shadow" style="border-radius: 10px; transition: transform 0.2s ease;" onmouseover="this.style.transform='translateY(-5px)';" onmouseout="this.style.transform='translateY(0)';">
                    <div class="card-body text-center p-3">
                        <div class="avatar-md mx-auto mb-3" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="ri-file-text-line fs-4 text-white"></i>
                        </div>
                        <h4 class="fw-bold text-info mb-1">{{ $totalInvoices }}</h4>
                        <p class="text-muted mb-0 small">Total Invoices</p>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="col-xl-3 col-md-6">
                <div class="card h-100 border-0 shadow" style="border-radius: 10px; transition: transform 0.2s ease;" onmouseover="this.style.transform='translateY(-5px)';" onmouseout="this.style.transform='translateY(0)';">
                    <div class="card-body text-center p-3">
                        <div class="avatar-md mx-auto mb-3" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="ri-money-dollar-circle-line fs-4 text-white"></i>
                        </div>
                        <h4 class="fw-bold text-warning mb-1">${{ number_format($totalRevenue, 2) }}</h4>
                        <p class="text-muted mb-0 small">Total Revenue</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg" style="border-radius: 20px; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);">
                    <div class="card-header bg-transparent border-0 text-center">
                        <h3 class="card-title mb-0 fw-bold text-primary">Quick Actions</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ route('clientCreate') }}" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center p-4" style="border-radius: 15px; transition: all 0.3s ease; border: 2px solid;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 10px 30px rgba(13, 110, 253, 0.2)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                                    <i class="ri-user-add-line fs-1 mb-3 text-primary"></i>
                                    <span class="fw-bold fs-5">Add New Client</span>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ route('productCreate') }}" class="btn btn-outline-success w-100 h-100 d-flex flex-column align-items-center justify-content-center p-4" style="border-radius: 15px; transition: all 0.3s ease; border: 2px solid;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 10px 30px rgba(25, 135, 84, 0.2)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                                    <i class="ri-shopping-bag-add-line fs-1 mb-3 text-success"></i>
                                    <span class="fw-bold fs-5">Add New Product</span>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ route('invoiceCreate') }}" class="btn btn-outline-info w-100 h-100 d-flex flex-column align-items-center justify-content-center p-4" style="border-radius: 15px; transition: all 0.3s ease; border: 2px solid;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 10px 30px rgba(13, 202, 240, 0.2)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                                    <i class="ri-file-add-line fs-1 mb-3 text-info"></i>
                                    <span class="fw-bold fs-5">Create Invoice</span>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ route('invoiceList') }}" class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center p-4" style="border-radius: 15px; transition: all 0.3s ease; border: 2px solid;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 10px 30px rgba(255, 193, 7, 0.2)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                                    <i class="ri-file-list-line fs-1 mb-3 text-warning"></i>
                                    <span class="fw-bold fs-5">Manage Invoices</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 