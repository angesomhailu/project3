<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    
    Route::resource('tasks', TaskController::class);

    // Car Management Routes
    Route::resource('cars', CarController::class);

    // Rental Management Routes
    Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
    Route::get('/rentals/create/{car?}', [RentalController::class, 'create'])->name('rentals.create');
    Route::post('/rentals', [RentalController::class, 'store'])->name('rentals.store');
    Route::get('/rentals/{rental}', [RentalController::class, 'show'])->name('rentals.show');

    Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto'])
        ->name('profile.update-photo');

    Route::post('/profile/update-billing', [ProfileController::class, 'updateBilling'])
        ->name('profile.update-billing');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.update-password')
        ->middleware('auth');

    Route::post('/profile/payment-method', [ProfileController::class, 'addPaymentMethod'])
        ->name('profile.add-payment-method')
        ->middleware('auth');

    Route::get('/cars/create', [CarController::class, 'create'])
        ->name('cars.create')
        ->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class]);

    Route::post('/cars', [CarController::class, 'store'])
        ->name('cars.store')
        ->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class]);
});

// Admin routes
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{user}/make-admin', [AdminController::class, 'makeAdmin'])->name('admin.make-admin');
    Route::post('/users/{user}/remove-admin', [AdminController::class, 'removeAdmin'])->name('admin.remove-admin');
    Route::get('/cars', [AdminController::class, 'cars'])->name('admin.cars');
    Route::get('/rentals', [AdminController::class, 'rentals'])->name('admin.rentals');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
});

require __DIR__.'/auth.php';
