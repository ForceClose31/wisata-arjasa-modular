<?php

use Illuminate\Support\Facades\Route;
use Modules\TourPackage\Http\Controllers\Admin\AdminTourPackageController;
use Modules\TourPackage\Http\Controllers\User\TourPackageController;

Route::middleware('locale')->group(function () {
    Route::controller(TourPackageController::class)->prefix('tour-package')->group(function () {
        Route::get('/', 'tourPackage')->name('tour-package.index');
        Route::get('/type/{packageType}', 'byType')->name('packages.by-type');
    });

    Route::get('/packages/{tourPackage}', [TourPackageController::class, 'show'])
        ->name('tour-packages.show');
});

Route::prefix('admin')
    ->middleware(['auth:admin', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::resource('tour-packages', AdminTourPackageController::class)->except('show');
    });
