<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Admin\LogoSettingController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

use Inertia\Inertia;

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

    // routes/web.php
    Route::middleware(['auth'])->group(function () {

        Route::prefix('admin')->name('admin.')->middleware(['role:admin'])->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
            Route::get('/dashboard', [AdminDashboardController::class, 'index']);

            Route::resource('users', UserController::class);
            Route::resource('plans', \App\Http\Controllers\Admin\PlanController::class);
            Route::resource('subscriptions', SubscriptionController::class);
            Route::resource('/invoices', AdminInvoiceController::class);
            Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
            Route::get('/reports/show', [ReportController::class, 'show'])->name('reports.show');


            Route::prefix('settings')->name('settings.')->group(function () {
                Route::get('/application', [SettingController::class, 'application'])->name('application');
                Route::get('/logo', [SettingController::class, 'logo'])->name('logo');
                Route::get('/storage', [SettingController::class, 'storage'])->name('storage');
                Route::get('/color', [SettingController::class, 'color'])->name('color');
                Route::post('/update', [SettingController::class, 'update'])->name('update');
            });
        });

        Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
        Route::post('/plans/{plan}/subscribe', [PlanController::class, 'subscribe'])->name('plans.subscribe');
        Route::post('/payment/confirm/{subscription}', [PaymentController::class, 'confirm'])->name('payment.confirm');
        Route::get('/subscriptions', function () {
            return Inertia::render('Subscriptions/Index');
        })->name('subscription.manage');
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.markRead');
        Route::get('/invoices', [InvoiceController::class, 'index'])->name('user.invoices');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});

require __DIR__ . '/auth.php';
