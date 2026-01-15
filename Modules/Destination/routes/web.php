<?php

use Illuminate\Support\Facades\Route;
use Modules\Destination\Http\Controllers\Admin\AdminDestinationController;
use Modules\Destination\Http\Controllers\User\TouristDestinationController;

Route::middleware('locale')->group(function () {
    Route::controller(TouristDestinationController::class)
        ->prefix('tourist-destination')
        ->name('tourist-destination.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{slug}', 'show')->name('show');
        });
});

Route::prefix('admin')
    ->middleware(['auth:admin', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::resource('destinations', AdminDestinationController::class)->except('show');
    });
