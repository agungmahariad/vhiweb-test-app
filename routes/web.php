<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('product', ProductController::class);

    Route::get('vendor', [PageController::class, 'vendor'])->name('vendor')->middleware(['role:Administrator']);
    Route::get('vendor/verify/{id}', [PageController::class, 'vendorVerify'])->name('vendor.verify')->middleware(['role:Administrator']);
    Route::get('buyer', [PageController::class, 'buyer'])->name('buyer')->middleware(['role:Administrator']);
});
