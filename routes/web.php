<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Bidan Registration (Guest only)
Route::get('register/bidan', App\Livewire\Auth\BidanRegistration::class)
    ->middleware('guest')
    ->name('register.bidan');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Test Wilayah API
Route::get('test-wilayah', App\Livewire\TestWilayah::class)
    ->middleware(['auth'])
    ->name('test.wilayah');

// Admin routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('bidan-verification', App\Livewire\Admin\BidanVerification::class)
        ->name('admin.bidan.verification');
});

// Bidan routes  
Route::middleware(['auth', 'verified', 'role:bidan'])->prefix('bidan')->group(function () {
    // Bidan specific routes will be added here
});

// Pasien routes
Route::middleware(['auth', 'verified', 'role:pasien'])->prefix('pasien')->group(function () {
    // Pasien specific routes will be added here
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
