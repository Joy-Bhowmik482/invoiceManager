<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConfigurationController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Search route
Route::get('/search', [SearchController::class, 'search'])->name('search');


// --- Client routes ---
Route::get('/clients', [ClientController::class, 'index'])->name('clientList');
Route::get('/clients/create', [ClientController::class, 'create'])->name('clientCreate');
Route::post('/clients', [ClientController::class, 'store'])->name('clientStore');
Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clientShow');
Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clientEdit');
Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clientUpdate');
Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clientDestroy');

// --- Product routes ---
Route::get('/products', [ProductController::class, 'index'])->name('productList');
Route::get('/products/create', [ProductController::class, 'create'])->name('productCreate');
Route::post('/products', [ProductController::class, 'store'])->name('productStore');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('productShow');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('productEdit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('productUpdate');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('productDestroy');

// --- Brand routes ---
Route::get('/brands', [BrandController::class, 'index'])->name('brandList');
Route::get('/brands/create', [BrandController::class, 'create'])->name('brandCreate');
Route::post('/brands', [BrandController::class, 'store'])->name('brandStore');
Route::get('/brands/{id}', [BrandController::class, 'show'])->name('brandShow');
Route::get('/brands/{id}/edit', [BrandController::class, 'edit'])->name('brandEdit');
Route::put('/brands/{id}', [BrandController::class, 'update'])->name('brandUpdate');
Route::delete('/brands/{id}', [BrandController::class, 'destroy'])->name('brandDestroy');

// --- Category routes ---
Route::get('/categories', [CategoryController::class, 'index'])->name('categoryList');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categoryCreate');
Route::post('/categories', [CategoryController::class, 'store'])->name('categoryStore');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categoryShow');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categoryEdit');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categoryUpdate');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categoryDestroy');

// --- Invoice routes ---
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoiceList');
Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoiceCreate');
Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoiceStore');
Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoiceShow');
Route::get('/invoices/{id}/edit', [InvoiceController::class, 'edit'])->name('invoiceEdit');
Route::put('/invoices/{id}', [InvoiceController::class, 'update'])->name('invoiceUpdate');
Route::delete('/invoices/{id}', [InvoiceController::class, 'destroy'])->name('invoiceDestroy');
Route::post('/invoices/{id}/payment', [InvoiceController::class, 'addPayment'])->name('invoiceAddPayment');
Route::patch('/invoices/{id}/mark-paid', [InvoiceController::class, 'markAsPaid'])->name('invoiceMarkPaid');
Route::patch('/invoices/{id}/mark-unpaid', [InvoiceController::class, 'markAsUnpaid'])->name('invoiceMarkUnpaid');

// --- Configuration Routes ---
Route::prefix('configurations')->name('configuration.')->group(function () {
    Route::get('/', [ConfigurationController::class, 'index'])->name('list');
    Route::get('/create', [ConfigurationController::class, 'create'])->name('create');
    Route::post('/storeConfiguration', [ConfigurationController::class, 'store'])->name('configstore');
    Route::get('/{configuration}', [ConfigurationController::class, 'show'])->name('show');
    Route::get('/{configuration}/edit', [ConfigurationController::class, 'edit'])->name('edit');
    Route::put('/{configuration}', [ConfigurationController::class, 'update'])->name('update');
    Route::delete('/{configuration}', [ConfigurationController::class, 'destroy'])->name('destroy');
});


