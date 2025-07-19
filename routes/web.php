<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BillingHistoryController;
use App\Http\Controllers\User\SubscriptionController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\UserController;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::get('/plans/form/{plan?}', [PlanController::class, 'form'])->name('plans.form');
    Route::post('/plans', [PlanController::class, 'save'])->name('plans.store');
    Route::put('/plans/{id}', [PlanController::class, 'save'])->name('plans.update');
    Route::delete('/plans/{id}', [PlanController::class, 'destroy'])->name('plans.destroy');
    Route::resource('subscriptions', SubscriptionController::class);
});


Route::middleware(['auth'])->as('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/subscriptions', SubscriptionController::class);
    Route::get('/billing-history', [BillingHistoryController::class, 'index'])->name('billing-history');

    Route::prefix('subscription')->as('subscription.')->group(function () {
        Route::get('/change-plan', [SubscriptionController::class, 'changePlanView'])->name('change-plan-view');
        Route::get('/change-plan/confirm', [SubscriptionController::class, 'confirmPlanChange'])->name('confirm');
        Route::get('/checkout-view', [SubscriptionController::class, 'showCheckout'])->name('checkout-view');
        Route::post('/checkout', [SubscriptionController::class, 'checkout'])->name('checkout');
    });
});


require __DIR__ . '/auth.php';
