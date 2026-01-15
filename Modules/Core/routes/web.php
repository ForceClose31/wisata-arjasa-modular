<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\AdminController;
use Modules\Core\Http\Controllers\Auth\AuthController;

Route::middleware('guest:admin')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::prefix('admin')
    ->middleware(['auth:admin', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/activities/refresh', [AdminController::class, 'refreshActivities'])->name('activities.refresh');
        Route::get('/activities', [AdminController::class, 'activities'])->name('activities');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
