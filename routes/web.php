<?php

use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\UserController;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::get('/plans/form/{plan?}', [PlanController::class, 'form'])->name('plans.form');
    Route::post('/plans', [PlanController::class, 'save'])->name('plans.store');
    Route::put('/plans/{id}', [PlanController::class, 'save'])->name('plans.update');
    Route::delete('/plans/{id}', [PlanController::class, 'destroy'])->name('plans.destroy');
    Route::resource('subscriptions', SubscriptionController::class);
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::resource('users', UserController::class);
});
require __DIR__ . '/auth.php';
