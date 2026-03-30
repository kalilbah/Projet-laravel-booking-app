<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserBookingController;
use App\Http\Middleware\EnsureCustomer;
use Illuminate\Support\Facades\Route;

Route::get('/', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');

// L'espace client reste accessible uniquement aux utilisateurs connectes, verifies et non administrateurs.
Route::middleware(['auth', 'verified', EnsureCustomer::class])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::delete('/dashboard/bookings/{booking}', [UserBookingController::class, 'destroy'])->name('dashboard.bookings.destroy');
});

// Les pages de profil sont reservees au parcours utilisateur classique, hors compte admin.
Route::middleware(['auth', EnsureCustomer::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
