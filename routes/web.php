<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VendorController;

// Route::view('/', 'user.dashboard')->name('user.dashboard');
Route::get('/', function () {
    return 'Working 🚀';
});

Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::view('/product', 'product.product')->middleware(['auth', 'verified'])->name('product');
Route::view('/product-type', 'product.product_type')->middleware(['auth', 'verified'])->name('product-type');
Route::view('profile', 'profile')->middleware(['auth'])->name('profile');
Route::view('/vendor', 'vendor.vendor')->middleware(['auth', 'verified'])->name('product');
Route::get("/vendor",[VendorController::class,'vendor'])->name('admin.vendor');

Route::get('/product-details/{id}',[VendorController::class,'product_details'])->name('product.details');


require __DIR__.'/auth.php';
