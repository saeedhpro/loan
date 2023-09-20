<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'showDashboard'])->middleware(['auth']);

Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->prefix('/dashboard')->group(function () {
    Route::get('/employers', [EmployerController::class, 'index'])->name('dashboard.employers.index');
    Route::get('/employers/create', [EmployerController::class, 'create'])->name('dashboard.employers.create');
    Route::post('/employers', [EmployerController::class, 'store'])->name('dashboard.employer.store');
    Route::get('/employers/{id}', [EmployerController::class, 'edit'])->name('dashboard.employers.edit');
    Route::put('/employers/{id}', [EmployerController::class, 'update'])->name('dashboard.employers.update');
    Route::delete('/employers/{id}', [EmployerController::class, 'destroy'])->name('dashboard.employers.destroy');
});

Route::middleware('auth')->prefix('/profile')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('/dashboard')->group(function () {
    Route::get('/loans', [LoanController::class, 'index'])->name('dashboard.loans');
    Route::get('/loans/request', [LoanController::class, 'showRequestLoan'])->name('dashboard.loans.request');
    Route::get('/loans/requests', [LoanController::class, 'loanRequests'])->name('dashboard.loans.requests');
    Route::post('/loans/requests', [LoanController::class, 'store'])->name('dashboard.loans.store');
    Route::get('/loans/requests/{id}', [LoanController::class, 'show'])->name('dashboard.loans.show');
    Route::post('/loans/requests/{id}/action', [LoanController::class, 'action'])->name('dashboard.loans.action');
});

require __DIR__.'/auth.php';
