<?php

use Illuminate\Support\Facades\Route;
use Modules\TourPackages\Http\Controllers\Admin\AdminTourPackagesController;
use Modules\TourPackages\Http\Controllers\User\TourPackagesController;

Route::middleware('locale')->group(function () {
    Route::controller(TourPackagesController::class)->prefix('tour-package')->group(function () {
        Route::get('/', 'tourPackage')->name('tour-package.index');
        Route::get('/type/{packageType}', 'byType')->name('packages.by-type');
    });

    Route::get('/packages/{tourPackage}', [TourPackagesController::class, 'show'])
        ->name('tour-packages.show');
});

Route::prefix('admin')
    ->middleware(['auth:admin', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::resource('tour-packages', AdminTourPackagesController::class)->except('show');
    });
